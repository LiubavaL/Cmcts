<?php

namespace App\Http\Controllers;


use App\ExtraCover;
use App\Notifications\NewComicReaction;
use Illuminate\Http\Request;
use App\Http\Requests\UploadComicRequest;
use App\Http\Requests\Upload2ComicRequest;
use App\Services\ComicService;
use App\Services\ChapterService;
use App\Models\Comic;
use App\Models\Volume;
use App\Models\Chapter;
use App\Models\ComicStatus;
use App\Models\Genre;
use App\Models\Image;
use App\Models\User;
use App\Models\ExtraCover as ExtraComicCover;
use Illuminate\Support\Facades\Auth;
use Spatie\Analytics\Period;
use Session;
use Analytics;
use File;
use Debugbar;
use DB;
use Illuminate\Support\Facades\Storage;

class ComicController extends Controller
{

    //CRUD
    public function getUpload1(){
        return view('comic.upload-1', ['comicStatuses' => ComicStatus::all(), 'genres' => Genre::all()]);
    }

    public function getUpload2(){
        return view('comic.upload-2');
    }

    public function postUpload1(UploadComicRequest $request){
        if(!$request->session()->has('title')){
            session(['title'=> $request->title]);
        }
        if(!$request->session()->has('description')){
            session(['description'=> $request->description]);
        }
        if(!$request->session()->has('status_id')){
            session(['status_id'=> $request->comic_status]);
        }
        if(!$request->session()->has('single')){
            session(['single'=> $request->single]);
        }
        if(!$request->session()->has('adult_content')){
            session(['adult_content'=> $request->adult_content]);
        }
        if(!$request->session()->has('cover')){
            session(['cover'=> $request->cover]);
        }
        if(!$request->session()->has('genres')){
            Session::push('genres',  collect($request->input('genres')));
        }
        if(!$request->session()->has('extra_covers')){
            Session::push('extra_covers', collect($request->input('extra-cover')));
        }

        return redirect('/comic/create-2');
    }

    public function postUpload2(Upload2ComicRequest $request, ComicService $comicService){
        //handle cover image upload
        $s3 = Storage::disk('s3');
        $adultContent = ($request->session()->pull('adult_content')) ? 1 : 0;
        $cover = null;
        $newExtraCovers = null;

        //start transaction
        DB::beginTransaction();

        if(session('cover')){
            $cover = $comicService->putCover($request->session()->pull('cover'), $s3);
        }else{
            // throw new ExtractFileException('Can\'t read file');
        }
        if(session('extra_covers')){
            $exCovers = $request->session()->pull('extra_covers');
            $newExtraCovers = $comicService->putExtraCovers($exCovers[0], $s3);
        }else{
            // throw new ExtractFileException('Can\'t read file');
        }


        $comic = Comic::create([
            'user_id' => Auth::id(),
            'title' => $request->session()->pull('title'),
            'description' => $request->session()->pull('description'),
            'cover' => $cover,
            'status_id' => $request->session()->pull('status_id'),
            'adult_content' => $adultContent
        ]);


        /* handle extra covers */
        $extraCover = new ExtraComicCover;
        $extraBatch = array();
        foreach ($newExtraCovers as $newExtraCover) {
            $extraBatch[] = array(
                'comic_id' => $comic->id,
                'image' => $newExtraCover
            );

        }

        $extraCover->insertAll($extraBatch);


        /* handle genres */
        $selectedGenresId = $request->session()->pull('genres');
        foreach ($selectedGenresId[0] as $selectedGenreId) {
            $comic->genres()->attach($selectedGenreId);
        }


        /* handle volumes */
        $volumesInput = $request->input('volumes', null);

        if(!$volumesInput){
            $volumesInput = array(
                0 => array(
                    'title' => '',
                    'sequence' => 0,
                    'chapters' =>  $request->input('chapters')
                )
            );
        }

        foreach ($volumesInput as $volumeKey => $volumeInput) {
            //checking if adding with volumes or not
            $volumeSequence = (isset($volumeInput['sequence']) && ($volumeInput['sequence']) === 0) ? 0 : $volumeKey + 1;

            $volume = Volume::create([
                'comic_id' => $comic->id,
                'title' => $volumeInput['title'],
                'sequence' => $volumeSequence
            ]);

            /* handle chapters */
            foreach ($volumeInput['chapters'] as $chapterKey => $chapterInput) {
                $chapter = Chapter::create([
                    'volume_id' => $volume->id,
                    'title' => $chapterInput['title'],
                    'sequence' => $chapterKey + 1
                ]);

                if($volumeSequence === 0){
                    $uploadedZipImages = $request->file('chapters.' . $chapterKey . '.pages');
                }else{
                    $uploadedZipImages = $request->file('volumes.' . $volumeKey . '.chapters.' . $chapterKey . '.pages');
                }

                //dd($uploadedZipImages);
                if ($uploadedZipImages != null) {//проверка необязательна здесь, так как клиентская и серверная валидации пройдены
                    try {
                        //распаковываем и сохраням zip
                        $resetedImages = $comicService->storeData($uploadedZipImages);
                        //dd($resetedImages);
                    } catch (\Exception $e) {//ошибка открытия файла
                        DB::rollback();
                        throw $e;
                    }

                    /* handle page images */
                    $imageSequence = 1;
                    $newImages = array();
                    $newImage = new Image;


                    foreach ($resetedImages as $fileName) {
                        $newImages[] = array(
                            'name' => $fileName,
                            'sequence' => $imageSequence++,
                            'chapter_id' => $chapter->id
                        );

                    }

                    $newImage->insertAll($newImages);
                }else{
                    dd('images are empty!');
                }
            }
        }
        /* commit new records */
        DB::commit();

        return redirect('/comic/'.$comic->slug)->with('success','Congrats! Comic was successful created.');
    }

    public function update(Request $request)
    {

    }

    public function delete(Request $request)
    {

    }


    //show
    public function showComic(Request $request, ComicService $comicService)
    {
        $comicSlug = $request->route('slug');

        $comic = Comic::with('volumes.chapters','extra_covers')->withCount('subscribers')->where('slug', $comicSlug)->first();
        $comic = $comicService->getPageviewsForComic($comic);
        $comic = $comicService->getSubscriptionsForComic($comic);

        $user = Auth::user();
        $isSubscribed = $user->hasSubscription($comic->id);
        $isSelfComic = $user->hasComic($comic);


        $likesCount = DB::table('likes')
            ->selectRaw('type_id, count(*) as type_count')
            ->where('comic_id', $comic->id)
            ->groupBy('type_id')
            ->get();

        $likesCount = $likesCount->pluck('type_count', 'type_id');
        $comic->likesCount = $likesCount;


        $hasLike = DB::table('likes')
            ->selectRaw('type_id')
            ->where('user_id', $user->id)
            ->where('comic_id', $comic->id)
            ->first();

        if($hasLike != null){
            $hasLike = $hasLike->type_id;
        }


        /* similar comics */
        $relatedComics = $comicService->getSimilar($comic, 6);

        if ($comic != null) {
            return view('comic.index', [
                'comic' => $comic,
                'isSubscribed' => $isSubscribed,
                'isSelfComic' => $isSelfComic,
                'hasLike' => $hasLike,
                'relatedComics' => $relatedComics
            ]);
        } else {
            return view('errors.404');
        }
    }

    public function showChapter(Request $request)
    {
        $comicSlug = $request->route('slug');
        $volumeSequence = $request->route('volSequence');
        $chapterSequence = $request->route('chSequence');

        $images = Image::whereHas('chapter', function ($query) use ($comicSlug, $volumeSequence, $chapterSequence) {
            $query->where('chapters.sequence', $chapterSequence)->whereHas('volumes', function ($query) use ($comicSlug, $volumeSequence) {
                $query->where('sequence', $volumeSequence)->whereHas('comic', function ($query) use ($comicSlug) {
                    $query->where('slug', $comicSlug);
                });
            });
        })->get();

        if (!$images->isEmpty()) {
            return view('comic.chapters', ['images' => $images]);
        } else {
            return view('errors.404');
        }
    }

    public function showImage(Request $request)
    {
        $comicSlug = $request->route('slug');
        $volumeSequence = $request->route('volSequence');
        $chapterSequence = $request->route('chSequence');
        $imageSequence = $request->route('imgSequence');

        /*$images = Image::whereIn('sequence', array($imageSequence, $nextSequence))->whereHas('chapter', function($query) use($comicSlug, $volumeSequence, $chapterSequence)  {
            $query->where('sequence', $chapterSequence)->whereHas('volume', function($query) use($comicSlug, $volumeSequence) {
                $query->where('sequence', $volumeSequence)->whereHas('comic', function($query) use($comicSlug) {
                    $query->where('slug', $comicSlug);
                });
            });
        })->get();*/

        $comic = Comic::with('volumes.chapters.images.image_comments.user')->where('slug', $comicSlug)->first();
        //извлекаем из дерева Collection изображения выбранной главы
        $volumes = $comic->volumes;

        //dd($comic->toArray());

        //извлекаем из дерева Collection изображения выбранной главы
        $chapters = $volumes->where('sequence', $volumeSequence)->first()
            ->chapters;

        //извлекаем из дерева Collection изображения выбранной главы
        $images = $chapters->where('sequence', $chapterSequence)->first()
            ->images;
        //извлекаем из дерева Collection комменты
/*        foreach($images as $image){
            $image['image_comments'] = $image->where('id', $image)->first()
                ->image_comments;
        }*/

        $curPage = $images->where('sequence', $imageSequence)->first();


        //next page data

        $nextPage = array();
        if (empty($images->where('sequence', $imageSequence + 1)->first())) {
            $nextPage['image'] = 1;
            $nextChapter = $chapters->where('sequence', $chapterSequence + 1)->first();

            if (empty($nextChapter)) {
                $nextPage = null;
            } else {
                //если есть следующая глава
                $nextPage['chapter'] = $chapterSequence + 1;

                //тогда ищем, в каком томе она находится
                $volumeId = collect($nextChapter->toArray())->get('volume_id');

                $nextPage['volume'] = collect($volumes->where('id', $volumeId)->first())->get('sequence');
            }
        } else {
            $nextPage['image'] = $imageSequence + 1;
            $nextPage['chapter'] = $chapterSequence;
            $nextPage['volume'] = $volumeSequence;
        }

        //prev page data
        $prevPage = array();
        if (empty($images->where('sequence', $imageSequence - 1)->first())) {
            //
            $prevChapter = $chapters->where('sequence', $chapterSequence - 1)->first();

            if (empty($prevChapter)) {
                $prevPage = null;
            } else {
                //если есть предыдущая глава
                $prevPage['chapter'] = $chapterSequence - 1;

                //находим кол-во картинок
                //посвящаю Фусе-чану
                $prevPage['image'] = $chapters->where('sequence', $prevPage['chapter'])->first()
                    ->images->count();

                //тогда ищем, в каком томе она находится
                $volumeId = collect($prevChapter->toArray())->get('volume_id');

                $prevPage['volume'] = collect($volumes->where('id', $volumeId)->first()->toArray())->get('sequence');
            }
        } else {
            $prevPage['image'] = $imageSequence - 1;
            $prevPage['chapter'] = $chapterSequence;
            $prevPage['volume'] = $volumeSequence;
        }

        /*dd(
            $prevPage
        );*/

        return view('comic.image',
            [
                'comic' => $comic,
                'chapterImages' => $images,
                'nextPage' => $nextPage,
                'curPage' => $curPage,
                'prevPage' => $prevPage,
                'volumeSequence' => $volumeSequence,
                'chapterSequence' => $chapterSequence,
                'imageSequence' => $imageSequence,
            ]
        );
    }
}
