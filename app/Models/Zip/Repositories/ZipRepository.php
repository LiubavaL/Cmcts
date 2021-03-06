<?php namespace App\Models\Zip\Repositories;

use Chumper\Zipper\Repositories\RepositoryInterface;
use App\Exceptions\OpenFileException;
use ZipArchive;

class ZipRepository implements RepositoryInterface
{
    private $archive;

    /**
     * Construct with a given path
     *
     * @param $filePath
     * @param bool $create
     * @param $archive
     * @throws \Exception
     * @return ZipRepository
     */
    function __construct($filePath, $create = false, $archive = null)
    {
        //Check if ZipArchive is available
        if (!class_exists('ZipArchive'))
            throw new Exception('Error: Your PHP version is not compiled with zip support');

        $this->archive = $archive ? $archive : new ZipArchive;

        $res = $this->archive->open($filePath, ($create ? ZipArchive::CREATE : null));
        if( $res !== true )
            throw new OpenFileException("Error: Failed to open $filePath! Error: " . $this->getErrorMessage($res));
    }

    private function getErrorMessage($resultCode)
    {
        switch ($resultCode) {
            case ZipArchive::ER_EXISTS:
                return 'ZipArchive::ER_EXISTS - File already exists.';
            case ZipArchive::ER_INCONS:
                return 'ZipArchive::ER_INCONS - Zip archive inconsistent.';
            case ZipArchive::ER_MEMORY:
                return 'ZipArchive::ER_MEMORY - Malloc failure.';
            case ZipArchive::ER_NOENT:
                return 'ZipArchive::ER_NOENT - No such file.';
            case ZipArchive::ER_NOZIP:
                return 'ZipArchive::ER_NOZIP - Not a zip archive.';
            case ZipArchive::ER_OPEN:
                return 'ZipArchive::ER_OPEN - Can\'t open file.';
            case ZipArchive::ER_READ:
                return 'ZipArchive::ER_READ - Read error.';
            case ZipArchive::ER_SEEK:
                return 'ZipArchive::ER_SEEK - Seek error.';
            default:
                return "An unknown error [$resultCode] has occurred.";
        }
    }

    /**
     * Add a file to the opened Archive
     *
     * @param $pathToFile
     * @param $pathInArchive
     * @return void
     */
    public function addFile($pathToFile, $pathInArchive)
    {
        $this->archive->addFile($pathToFile, $pathInArchive);
    }

    /**
     * Add an empty directory
     *
     * @param $dirName
     * @return void
     */
    public function addEmptyDir($dirName)
    {
        $this->archive->addEmptyDir($dirName);
    }

    /**
     * Add a file to the opened Archive using its contents
     *
     * @param $name
     * @param $content
     * @return void
     */
    public function addFromString($name, $content)
    {
        $this->archive->addFromString($name, $content);
    }

    /**
     * Remove a file permanently from the Archive
     *
     * @param $pathInArchive
     * @return void
     */
    public function removeFile($pathInArchive)
    {
        $this->archive->deleteName($pathInArchive);
    }

    /**
     * Get the content of a file
     *
     * @param $pathInArchive
     * @return string
     */
    public function getFileContent($pathInArchive)
    {
        return $this->archive->getFromName($pathInArchive);
    }

    /**
     * Get the stream of a file
     *
     * @param $pathInArchive
     * @return mixed
     */
    public function getFileStream($pathInArchive)
    {
        return $this->archive->getStream($pathInArchive);
    }

    /**
     * Will loop over every item in the archive and will execute the callback on them
     * Will provide the filename for every item
     *
     * @param $callback
     * @return void
     */
    public function each($callback)
    {
        for ($i = 0; $i < $this->archive->numFiles; $i++) {

            //skip if folder
            $stats = $this->archive->statIndex($i);
            if ($stats['size'] == 0 && $stats['crc'] == 0)
                continue;

            call_user_func_array($callback, array(
                'file' => $this->archive->getNameIndex($i),
            ));
        }
    }
    /**
     * Will loop over every item in the archive and will execute the callback on them
     * Will provide the filename for every item
     *
     * @param $callback
     * @return void
     */
    public function resetImageNames($currentFolder, $imageNames)
    {
        $newImageName= array();
        echo 'zip repository image names<br>';
        var_dump($imageNames);

        for($i = 0; $i < count($imageNames); $i++){
            $newName = md5(time().$imageNames[$i]);
            $ext = get_extension($imageNames[$i]);

            $result = $this->archive->renameName($imageNames[$i], $currentFolder.$newName.'.'.$ext);
            echo $currentFolder.$newName.'.'.$ext.'<br>';

            /*
             * $imgThumb = InterventionImage::make($request->image)
                      ->resize(300, null, function ($constraint) {$constraint->aspectRatio();})
                      ->crop(300, 300);

            $imgThumb = $imgThumb->stream();
            $s3->put($dirThumb.$imageName, $imgThumb->__toString(), 'public');
             * */

            $newImageName[] = $newName.'.'.$ext;
        }
        return $newImageName;
    }

    /**
     * Checks whether the file is in the archive
     *
     * @param $fileInArchive
     * @return boolean
     */
    public function fileExists($fileInArchive)
    {
        return $this->archive->locateName($fileInArchive) !== false;
    }

    /**
     * Sets the password to be used for decompressing
     * function named usePassword for clarity
     *
     * @param $password
     * @return boolean
     */
    public function usePassword($password)
    {
        return $this->archive->setPassword($password);
    }

    /**
     * Returns the status of the archive as a string
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->archive->getStatusString();
    }

    /**
     * Closes the archive and saves it
     * @return void
     */
    public function close()
    {
        @$this->archive->close();
    }
}
