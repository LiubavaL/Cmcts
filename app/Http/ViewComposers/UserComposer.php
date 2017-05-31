<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Auth;

class UserComposer
{
    protected $user;

    public function __construct(){
        $this->user = Auth::user();
    }

    public function compose(View $view){
        $view->with('authUser', $this->user);
    }
}