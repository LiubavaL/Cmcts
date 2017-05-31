<?php
namespace App\Services;

use App\Models\Comic;
use App\Models\Zip\Zip;
use App\Exceptions\ExtractFileException;
use App\Exceptions\OpenFileException;
use Illuminate\Support\Facades\Storage;
use Spatie\Analytics\Period;
use Analytics;
use App\Facades\Cover;

class ComicService {
    public function storeData($uploadedFile){
        $imagesName = null;

        switch($uploadedFile->getClientOriginalExtension()){
            case 'zip':
                $imagesName = $this->storeArchiveData($uploadedFile);
                break;
            case 'png':
            case 'jpeg':
            case 'gif':
            case 'jpg':
                $imagesName = $this->storeImageData($uploadedFile);
                break;
        }
        return $imagesName;
    }

    public function storeImageData($uploadedImage){
        $s3 = Storage::disk('s3');
        $imageName = time().'.'.$uploadedImage->getClientOriginalExtension();

        Cover::store($uploadedImage, null, get_s3_page_path($imageName), $s3);

        return array(
            0 => $imageName
        );
    }

    public function storeArchiveData($uploadedZipImages){
        /*
                   **ПРОВЕРКА
                       Экзотический формат архива, -- form request
                       Архив запаролен. -- ничего не распаковывает
                       Многотомный архив. -- ничего не распаковывает
                       Архив имеет структуру вложенных папок. --- на данный момент распаковываются и вложенные
                       Архив повредился во время отправки. -- скорее всего, тоже при чтении выдаст ошибку
                   **/
        $fullName = $uploadedZipImages->getClientOriginalName();
        $ext = $uploadedZipImages->getClientOriginalExtension();
        $archiveName = str_replace('.' . $ext, '', $fullName);
        //$path = public_path() . '/images/test/';

        $zipper = new Zip;

        try {

       /*$rar = new \RarArchiver($uploadedZipImages, \RarArchiver::CREATE);
         if ($rar->isRar()) {
             //var_dump($rar->getNameIndex(1));
             //var_dump( $rar->renameName('random_type\pic11.png', 'random_type/1.png'));
             $rar->extractTo($path);

             //s3 = Storage::disk('s3');

             //$s3->put('pic11.png', $rar->getFileStream('random_type\pic11.png'), 'public');

             echo 'RAR!<br>';
         }

         dd($rar);*/

            $zipper->make($uploadedZipImages, 'zip');

            $imageNames = $zipper->listFiles('/\.jpg|\.png|\.gif$/i');
            usort($imageNames, 'strnatcasecmp');
            //var_dump($imageNames);

            //проверяем, в корне ли изображения, либо же в папке
            $zipperFolder = (dirname($imageNames[0]) == $archiveName) ? $archiveName : '';
            //echo 'zipperFolder = ' . $zipperFolder;
            $actualFolder = (!empty($zipperFolder)) ? $zipperFolder . '/' : '';

            //$resetedImages = [];
            $resetedImages = $zipper->resetImageNames($actualFolder, $imageNames);
            //echo 'reseted images';
            //var_dump($resetedImages);

            //echo 'reseted listFiles';
            //var_dump($zipper->listFiles());
            //проверка: если resetedImages пустое, то ошибка и редирект
            $zipper->close();

            //open for extracting
            $zipper->make($uploadedZipImages, 'zip');

            //throw new ReadFileException('cant read zip');
            $zipper->folder($zipperFolder)->extractTo('', $resetedImages, Zip::WHITELIST);

            } catch (ExtractFileException $e) {//ошибка чтения файла при распаковке
                $zipper->close();
                throw $e;
          } catch (OpenFileException $e) {//ошибка открытия файла
                $zipper->close();
                throw $e;
            }
        $zipper->close();

        return $resetedImages;
    }

    public function putCover($imageBase64, $s3){
        if(!empty($imageBase64)){
            $imageName = time() . '.png';

            Cover::store($imageBase64, [420, 600], get_s3_cover_path('l').$imageName, $s3);
            Cover::store($imageBase64, [208, 297], get_s3_cover_path('m').$imageName, $s3);
            Cover::store($imageBase64, [136, 194], get_s3_cover_path('s').$imageName, $s3);

            return $imageName;
        }
        return null;
    }

    public function putExtraCovers($imagesBase64, $s3){
        $coverImages = array();

        foreach($imagesBase64 as $imageBase64){
            if(!empty($imageBase64)){
                $imageName = time() . '.png';
                $coverImages[] = $imageName;

                //$this->storeImage($cover, [1280, 518], $imageName, $s3, 'extra');
                Cover::store($imageBase64, [1280, 518], get_s3_cover_path('extra').$imageName, $s3);
            }
        }
        return $coverImages;
    }

    /*public function storeImage($cover, $size, $imageName, $s3, $s3Folder){
        $cover->resize($size[0], $size[1]);
        $cover_l = $cover->stream();
        $s3->put(get_s3_cover_path($s3Folder).$imageName, $cover_l->__toString(), 'public');
    }*/

    public function getPageviewsForComics($comics){
        foreach($comics as $comic){
            $comic = $this->getPageviewsForComic($comic);
        }
        return $comics;
    }

    public function getPageviewsForComic($comic){
        $views = Analytics::fetchPageviewsForUrl(Period::days(7), '/comic/'.$comic->slug)->first();
        $comic->views = $views['pageViews'];

        return $comic;
    }

    public function getCommentsForComics($comics){
        foreach($comics as $comic){
           // $comic['comments'] = $comic->comments_count;
            $comic['comments_count'] = ($comic['comments_count']) ? $comic['comments_count'] : 0;
        }

        return $comics;
    }

    public function getSubscriptionsForComics($comics){
        foreach($comics as $comic){
            $comic = $this->getSubscriptionsForComic($comic);
        }

        return $comics;
    }

    public function getSubscriptionsForComic($comic){
        $comic['subscribers_count'] = ($comic['subscribers_count']) ? $comic['subscribers_count'] : 0;

        return $comic;
    }

    public function getComicsPreviewData($comic){
        $comic = $this->getSubscriptionsForComics($comic);
        $comic = $this->getCommentsForComics($comic);
        $comic = $this->getPageviewsForComics($comic);

        return $comic;
    }


    public function getSimilar($comic, $limit = 6){
        $comicGenres = $comic->genres->modelKeys();

        $similarComics = Comic::with('user')->whereHas('genres', function($query) use($comicGenres){
            $query->whereIn('genres.id', $comicGenres);
        })->where('id', '<>', $comic->id)
            ->orderBy('rating')
            ->take($limit)
            ->get();

        $similarComics = $this->getComicsPreviewData($similarComics);

        return $similarComics;
    }

    public function hasLike(){

    }

}