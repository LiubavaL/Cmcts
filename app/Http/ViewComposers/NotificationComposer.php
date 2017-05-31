<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Auth;

class NotificationComposer
{
    protected $user;

    public function __construct(){
        $this->user = Auth::user();
    }

    public function compose(View $view){
        if($this->user){
            $view->with('unreadNotifications', $this->user->unreadNotifications->count());
        }
    }
}