<?php

namespace App\Listeners;

use App\Events\UserSignedUp;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\UserRegistered;
use Illuminate\Support\Facades\Mail;
use App\Models\ConfirmUsers;

class SendConfirmationEmail
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
     * @param  UserSignedUp  $event
     * @return void
     */
    public function handle(UserSignedUp $event)
    {
        $this->sendConfirmationEmail($event->user);
    }

    public function sendConfirmationEmail($user){

        $activationLink = $this->addConfirmation($user);

        Mail::to($user)->send(new UserRegistered($activationLink));

        return view('user.profile', ['activationMailSent' => true]);
    }



    private function addConfirmation($user){
        $confirmation = new ConfirmUsers;

        $confirmation->token = str_random(32);
        $confirmation->email = $user->email;
        $confirmation->save();

        $confirmationLink = 'http://comicats.herokuapp.com/activate/'.$confirmation->token;

        return $confirmationLink;
    }
}
