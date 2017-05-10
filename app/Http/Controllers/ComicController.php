<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\UploadComicRequest;
use App\Services\ComicService;
use App\Models\Comic;
use App\Models\Volume;
use App\Models\Chapter;
use App\Models\ComicStatus;
use App\Models\Genre;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Spatie\Analytics\Period;
use Analytics;
use File;
use Debugbar;
use Log;
use DB;
use Illuminate\Support\Facades\Storage;

class ComicController extends Controller
{

    public function like(Request $request)
    {
        $comicSlug = $request->route('slug');
        $comic = Comic::where('slug', $comicSlug)->first();
        $user = Auth::user();

        $user->like($comic->id);

        return redirect()->back();
    }

    public function dislike(Request $request)
    {
        $comicSlug = $request->route('slug');
        $comic = Comic::where('slug', $comicSlug)->first();
        $user = Auth::user();

        $user->dislike($comic->id);

        return redirect()->back();
    }

    //CRUD
    public function getUpload(Request $request)
    {
        return view('comic.upload', ['comicStatuses' => ComicStatus::all(), 'genres' => Genre::all()]);
    }

    public function postUpload(UploadComicRequest $request, ComicService $comicService)
    {
        //handle cover image upload
        $s3 = Storage::disk('s3');
        $imageName = time() . '.' . $request->cover->getClientOriginalExtension();
        if($request->cover){
            $s3->put(get_s3_path($imageName).$imageName, $request->cover, 'public');
        }else{
           // throw new ExtractFileException('Can\'t read file');
        }

        $adultContent = (!empty($request->adult_content)) ? 1 : 0;

        //start transaction
        DB::beginTransaction();

        //create comic instance
        /*$comic = new Comic;
        $comic->user_id = Auth::id();
        $comic->title = $request->title;
        $comic->description = $request->description;
        $comic->cover = $imageName;
        $comic->status_id = $request->comic_status;
        $comic->adult_content = $adultContent;

        $comic->save();*/

        $comic = Comic::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'cover' => $imageName,
            'status_id' => $request->comic_status,
            'adult_content' => $adultContent
        ]);

        //handle genres
        $selectedGenresId = $request->input('genres');

        foreach ($selectedGenresId as $selectedGenreId) {
            $comic->genres()->attach($selectedGenreId);
        }

        //handle volumes
        $volumesInput = $request->input('volume');

        foreach ($volumesInput as $volumeKey => $volumeInput) {
            $volume = Volume::create([
                'comic_id' => $comic->id,
                'title' => $volumeInput['title'],
                'sequence' => $volumeKey + 1
            ]);

            //handle chapters
            foreach ($volumeInput['chapter'] as $chapterKey => $chapterInput) {
                $chapter = Chapter::create([
                    'volume_id' => $volume->id,
                    'title' => $chapterInput['title'],
                    'sequence' => $chapterKey + 1
                ]);

                $uploadedZipImages = $request->file('volume.' . $volumeKey . '.chapter.' . $chapterKey . '.chapter_images');

                if ($uploadedZipImages != null) {//проверка необязательна здесь, так как клиентская и серверная валидации пройдены
                    /*
                    **ПРОВЕРКА
                        Экзотический формат архива, -- form request
                        Архив запаролен. -- ничего не распаковывает
                        Многотомный архив. -- ничего не распаковывает
                        Архив имеет структуру вложенных папок. --- на данный момент распаковываются и вложенные
                        Архив повредился во время отправки. -- скорее всего, тоже при чтении выдаст ошибку

                    $fullName = $uploadedZipImages->getClientOriginalName();
                    $fullExtension = '.' . $uploadedZipImages->getClientOriginalExtension();
                    $archiveName = str_replace($fullExtension, '', $fullName);
                    $path = public_path() . '/images/test/';
                    $zipper = new Zipper;
                    try {

                        $zipper->make($uploadedZipImages);

                        $imageNames = $zipper->listFiles('/\.jpg$/i');
                        usort($imageNames, 'strnatcasecmp');
                        // var_dump($imageNames);

                        //проверяем, в корне ли изображения, либо же в папке
                        $zipperFolder = (dirname($imageNames[0]) == $archiveName) ? $archiveName : '';
                        //echo 'zipperFolder = ' . $zipperFolder;
                        $actualFolder = (!empty($zipperFolder)) ? $zipperFolder . '/' : '';

                        $resetedImages = $zipper->resetImageNames($actualFolder, $imageNames);
                        //var_dump('reseted images');
                        //var_dump($resetedImages);
                        //TODO если в архиве есть директория с имененм архива, то перенести в корень и распаковать
                        //проверка: если resetedImages пустое, то ошибка и редирект
                        $zipper->close();

                        //open for extracting

                        $zipper->make($uploadedZipImages);

                        //throw new ReadFileException('cant read zip');
                        $zipper->folder($zipperFolder)->extractTo($path, $resetedImages, Zipper::WHITELIST);

                    } catch (ExtractFileException $e) {//ошибка чтения файла при распаковке
                        $zipper->close();
                        throw $e;
                    } catch (\OpenFileException $e) {//ошибка открытия файла
                        $zipper->close();
                        throw $e;
                    }
                    $zipper->close();
                    **/

                    try {
                        $resetedImages = $comicService->storeArchiveData($uploadedZipImages);
                    } catch (\Exception $e) {//ошибка открытия файла
                        DB::rollback();
                        throw $e;
                    }

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
                }
            }
        }

        //commit new records
        DB::commit();

        return redirect('/comic/'.$comic->slug)->with('success','Комикс успешно создан.');
    }

    public function update(Request $request)
    {

    }

    public function delete(Request $request)
    {

    }


    //show
    public function showComic(Request $request)
    {
        $comicSlug = $request->route('slug');
        $analyticsData = Analytics::fetchPageviewsForUrl(Period::days(7), '/comic/'.$comicSlug);
        //dd($analyticsData->toArray());

        //eager loading -> ('volumes.chapters')
        $comic = Comic::with('volumes.chapters')->where('slug', $comicSlug)->first();
        $user = Auth::user();
        $hasLike = $user->hasLike($comic->id);

        if ($comic != null) {
            return view('comic.index', [
                'comic' => $comic,
                'hasLike' => $hasLike,
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
                'prevPage' => $prevPage,
                'volumeSequence' => $volumeSequence,
                'chapterSequence' => $chapterSequence,
                'imageSequence' => $imageSequence,
            ]
        );
    }
}
