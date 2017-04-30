<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Image as InterventionImage;
use Validator;

class ImageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function handleImageUpload(Request $request)
    {  
      /*$this->validate($request, [
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);*/
      $validator = Validator::make($request->all(), [
        //'title' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
      ]);

      if ($validator->passes()){
        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        //$request->image->move(public_path('images'), $imageName);
        
        $s3 = Storage::disk('s3');
        $dirNormal = 'normal/';
        $dirThumb = 'thumb/';

        $imgNormal = InterventionImage::make($request->image);
        $imgNormal = $imgNormal->stream();
        $s3->put($dirNormal.$imageName, $imgNormal->__toString(), 'public');

        
        $imgThumb = InterventionImage::make($request->image)
                      ->resize(300, null, function ($constraint) {$constraint->aspectRatio();})
                      ->crop(300, 300);

        $imgThumb = $imgThumb->stream();
        $s3->put($dirThumb.$imageName, $imgThumb->__toString(), 'public');

        //write in database
        $post = new Post;

        $post->user_id = Auth::id();
        $post->title = 'post_name';
        $post->description = 'post_description';

        $post->save();

        $image = new Image;
        $image->name = $imageName;
        $post->images()->save($image);

        return redirect('/submit')->with('success','Image Uploaded successfully.')->with('path',$imageName);
      }else{
        return back()
            ->withErrors($validator);
      }
    }
}
