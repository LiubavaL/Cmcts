<?php

namespace App\Http\Controllers;

use App\Notifications\NewComicResponce;
use Illuminate\Http\Request;
use App\Models\Comment;
use Auth;

class CommentController extends Controller
{
    public function add(Request $request){
        $imageId = $request->input('id');
        $commentText = $request->input('comment');
        $user = Auth::id();

        $comment = new Comment;
        $comment->image_id = $imageId;
        $comment->content = $commentText;
        $comment->user_id = $user;

        $comment->save();

        //$user->notify(new NewComicResponce($user, $comic));

        return redirect()->back();
    }
}
