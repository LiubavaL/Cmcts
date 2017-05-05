<?php

namespace App\Listeners;

use App\Events\ActivateUser;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActivateUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ActivateUser  $event
     * @return void
     */
    public function handle(ActivateUser $event)
    {
        $this->activateUser($event->request);//TODO передать как-то параметр request через event
    }


    public function activateUser(Request $request){
        $token = $request->route('token');
        $resultMessage = false;

        $confirmation = $this->getActivation($token);

        $user = User::find('email', $confirmation->email);
        $user->is_verified = true;
        $user->save();

        if($user){
            $this->removeActivation($confirmation);
            $resultMessage = true;

        }
        return view('user.profile', ['activated' => $resultMessage]);
    }

    private function getActivation($token){
        return ConfirmUsers::find('token', $token);
    }

    private function removeActivation($confirmation){
        $confirmation->delete();
    }
}
