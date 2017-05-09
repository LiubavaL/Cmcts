<?php


if (! function_exists('get_s3_backet')) {
    /**
     * Return generated s3 path from image name
     *
     *
     * @param string $fileName
     * @return string
     */
    function get_s3_bucket()
    {
        return 'https://s3.amazonaws.com/webc-images/';
    }
}

if (! function_exists('get_s3_path')) {
    /**
     * Return generated s3 path from image name
     *
     *
     * @param string $fileName
     * @return string
     */
    function get_s3_path($fileName)
    {
        $path = substr($fileName, 0, 1).'/'.substr($fileName, 1, 1).'/';
        return $path;
    }
}

if (! function_exists('get_image_path')) {
    /**
     * Return generated s3 path from image name
     *
     *
     * @param string $fileName
     * @return string
     */
    function get_comicpage_path($fileName)
    {
        return get_s3_bucket().get_s3_path($fileName);
    }
}

if (! function_exists('get_avatar_path')) {
    /**
     * Return generated s3 path from image name
     *
     *
     * @param string $fileName
     * @return string
     */
    function get_avatar_path()
    {
        return get_s3_bucket().'avatars/';
    }
}

if (! function_exists('get_extension')) {
    /**
     * Return generated s3 path from image name
     *
     *
     * @param string $fileName
     * @return string
     */
    function get_extension($fileName)
    {
        $ext = substr($fileName, strrpos($fileName, '.') + 1);
        return $ext;//
    }
}