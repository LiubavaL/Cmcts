<?php

namespace App\Helpers;
use Image as InterventionImage;

class CoverHelper{
    public function store($image, $size, $s3Path, $s3){
        $cover = InterventionImage::make($image);

        if($size){
            $cover->resize($size[0], $size[1]);
        }
        $coverStream = $cover->stream();
        $s3->put($s3Path, $coverStream->__toString(), 'public');
    }
}