<?php
namespace App\Services;

use Chumper\Zipper\Zipper;
use App\Exceptions\ExtractFileException;
use App\Exceptions\OpenFileException;
use Illuminate\Support\Facades\Storage;

class ComicService {

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
        $path = public_path() . '/images/test/';

        $zipper = new Zipper;

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
            $zipper->folder($zipperFolder)->extractTo($path, $resetedImages, Zipper::WHITELIST);

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
}