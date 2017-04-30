<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Auth;

class CommentController extends Controller
{
    public function add(Request $request){
        $imageId = $request->input('id');
        $commentText = $request->input('comment');

        $comment = new Comment;
        $comment->image_id = $imageId;
        $comment->content = $commentText;
        $comment->user_id = Auth::id();

        $comment->save();

        return redirect()->back();
    }
}
