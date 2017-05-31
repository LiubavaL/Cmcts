<?php
namespace App\Services;
use App\Facades\Cover;
use Image as InterventionImage;
use Illuminate\Support\Facades\Storage;

class ProfileService {

    public function putAvatar($imageBase64){

        if(!empty($imageBase64)){
            $s3 = Storage::disk('s3');
            $imageName = time() . '.png';

            Cover::store($imageBase64, [120, 120], get_avatar_path('xl').$imageName, $s3);
            Cover::store($imageBase64, [60, 60], get_avatar_path('l').$imageName, $s3);
            Cover::store($imageBase64, [50, 50], get_avatar_path('m').$imageName, $s3);
            Cover::store($imageBase64, [20, 20], get_avatar_path('s').$imageName, $s3);

            return $imageName;
        }
        return null;
    }
}