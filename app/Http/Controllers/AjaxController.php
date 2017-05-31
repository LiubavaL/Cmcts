<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comic;
use App\Models\ComicComment;
use App\Models\Comment;
use Auth;
use View;
use DB;

class AjaxController extends Controller
{

    public function search(Request $request){
        if($request->ajax()){
            $q = $request->input('q');
            $itemsHtml = '';
            $html = '';

            $results = DB::table('comics')
                ->leftJoin('users', function ($join)  use($q) {
                    $join->on('comics.user_id', '=', 'users.id')->where('name', 'LIKE', '%'.$q.'%');
                })
                ->whereNotNull('name')
                ->orWhere('title', 'LIKE', '%'.$q.'%')
                ->get();
            //$results = DB::select(DB::raw("select * from `comics`, `users`.`name`, `users`.`id`, `users`.`image` left join `users` on `comics`.`user_id` = `users`.`id` and `users`.`name` LIKE '%$q%' where `users`.`name` is NOT NULL or `comics`.`title` LIKE '%$q%'"));

            /*$results = Comic::whereHas('user', function($query) use($q) {
                $query->addSelect('name')->where('name', 'LIKE', '%'.$q.'%');
            })->orWhere('title','LIKE','%'.$q.'%')->get();*/

            //dd($results->toArray());
            foreach($results as $result){
                //if comic entity
                if(isset($result->name)){
                    $author = $result;
                    $html = View::make("search.author", compact('author'))->render();
                }else{
                    $comic = $result;
                    $html = View::make("search.comic", compact('comic'))->render();
                }
                $itemsHtml.=$html;
            }

            return response()->json(array(
                'status' => 200,
                'items' => $itemsHtml
            ));
        }else {
            return redirect()->back();
        }
    }

    public function feed(Request $request){
        $user = $request->user();
        $notifications = array();
        $itemsHtml = ' <div class="notification notification_size_s">';
        $html = '';

        if ($user && $request->ajax()){
            if($user->unreadNotifications->count() > 0){
                $notifications = $user->unreadNotifications;
            }else{
                $notifications = $user->notifications;
            }

            foreach($notifications as $notification){
                switch($notification->type){
                    case 'App\Notifications\NewComicResponce':
                        $html = View::make('user.notifications.partial.notification.types.new-responce', compact('notification'))->render();
                        break;
                    case 'App\Notifications\NewComicReaction':
                        $html = View::make('user.notifications.partial.notification.types.new-reaction', compact('notification'))->render();
                        break;
                    case 'App\Notifications\NewComicSubscription':
                        $html = View::make('user.notifications.partial.notification.types.new-subscription', compact('notification'))->render();
                        break;
                    case 'App\Notifications\NewFollower':
                        $html = View::make('user.notifications.partial.notification.types.new-follower', compact('notification'))->render();
                        break;
                }

                $itemsHtml.=$html;
            }
            $itemsHtml.='</div>';

            return response()->json(array(
                'status' => 200,
                'items' => $itemsHtml
            ));

        }else {
            return redirect()->back();
        }
    }


    public function addResponce(Request $request){
        $data = $request->all();
        $responce = $data['responce'];
        $comicId = $data['comic_id'];
        $user_id = Auth::id();

        if ($user_id && $request->ajax()) {
            $comment = new ComicComment;
            $comment->content = $responce;
            $comment->comic_id = $comicId;
            $comment->user_id = $user_id;

            $comment->save();

            $commentHtml = View::make('comic.partial.responces.responce', compact('comment'))->render();

            return response()->json(array(
                'status' => 200,
                'responce' => $commentHtml
            ));
        }else{
            return redirect()->back();
        }
    }

    public function addComment(Request $request){
        $data = $request->all();
        $imageId = $data['iid'];
        $commentText = $data['comment'];
        $user_id = Auth::id();

        if ($user_id && $request->ajax()) {
            $comment = new Comment;
            $comment->image_id = $imageId;
            $comment->content = $commentText;
            $comment->user_id = $user_id;

            $comment->save();

            $commentHtml = View::make('comic.partial.page-controls.image_comment', compact('comment'))->render();

            //$user->notify(new NewComicResponce($user, $comic));

            return response()->json(array(
                'status' => 200,
                'comment' => $commentHtml
            ));
        }else{
            return redirect()->back();
        }
    }

    //subscription
    public function subscribe(Request $request)
    {
        $user = Auth::user();
        $comic_id = $request->input('comic_id');

        if ($user && $request->ajax()) {
            $user->subscribe($comic_id);

            //$user->notify(new NewComicSubscription($user, $comic));
            $linkHtml = View::make('comic.partial.subscribe.unsubscribe')->render();

            return response()->json(array(
                'status' => 200,
                'link' => $linkHtml
            ));
        }else{
            return redirect()->back();
        }
    }

    public function unsubscribe(Request $request)
    {
        $user = Auth::user();
        $comic_id = $request->input('comic_id');

        if ($user && $request->ajax()) {
            $user->unsubscribe($comic_id);
            $linkHtml = View::make('comic.partial.subscribe.subscribe')->render();

            return response()->json(array(
                'status' => 200,
                'link' => $linkHtml
            ));
        }else{
            return redirect()->back();
        }
    }

    //like
    public function like(Request $request)
    {
        $user = Auth::user();
        $comic_id = $request->input('comic_id');
        $type_id = $request->input('type_id');

        if ($user && $request->ajax()) {
            $user->like($comic_id, $type_id);
            //$comic = Comic::where($comic_id)->with('likes')->first();

            $comic = Comic::whereHas('likes', function($query) use($type_id) {
                $query->where('type_id', $type_id);
            })->where('id', $comic_id)->first();

            $type_count = $comic->likes->count();

            //$user->notify(new NewComicReaction($user, $comic));

            return response()->json(array(
                'status' => 200,
                $type_id => $type_count
            ));
        }else{
            return redirect()->back();
        }
    }

    public function dislike(Request $request)
    {
        $user = Auth::user();
        $comic_id = $request->input('comic_id');

        if ($user && $request->ajax()) {
            $user->dislike($comic_id);
            //$user->notify(new NewComicReaction($user, $comic));

            return response()->json(array(
                'status' => 200
            ));
        }else{
            return redirect()->back();
        }
    }

}
