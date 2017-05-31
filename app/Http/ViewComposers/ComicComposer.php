<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Comic;
use Auth;

class ComicComposer
{
    protected $comics;

    public function __construct(){
        $authUser = Auth::user();
        if($authUser){
            $this->comics = Comic::where('user_id', $authUser->id)->get();
        }
    }

    public function compose(View $view){
        if($this->comics) {
            $view->with('userComics', $this->comics);
        }
    }
}