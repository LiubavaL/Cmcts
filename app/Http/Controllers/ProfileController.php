<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateSettingsRequest;
use App\Http\Requests\BlockUserRequest;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\MessageBag;
use Image as InterventionImage;
use Illuminate\Support\Facades\Storage;
use App\Models\Comic;
use App\Models\User;
use App\Models\Country;
use Auth;
use Debugbar;
use Validator;
use Event;
use App\Events\UserSignedUp;

class ProfileController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProfile(Request $request)
    {
        $userId = $request->route('id');
        $user = null;
        $authUser = Auth::user();
        $isFollowing = false;

        if($userId){
            $user = User::where('id', $userId)->first();
            $isFollowing = $authUser->isFollowing($user->id, $authUser->id);
        }else{
            $user = $authUser;
        }

        $comics = Comic::with('status')->where('user_id', $user->id)->get();
        //$comics = Comic::with('volumes.chapters.images')->where('user_id', Auth::id())->get();

        //dd($user->toArray());
        return view('user.profile', [
            'user' => $user,
            'comics' => $comics,
            'isFollowing' => $isFollowing
        ]);
    }

    public function getSettings(Request $request)
    {
        $user = Auth::user();
        $activeTab = $request->route('tab');
        $countries = null;

        if($activeTab == 'account'){
            $countries = Country::orderBy('name')->get();
        }

        return view('user.settings', [
            'user' => $user,
            'activeTab' => $activeTab,
            'countries' => $countries
        ]);
    }

    public function postSettings(UpdateSettingsRequest $request)
    {
        $user = Auth::user();
        $activeTab = $request->input('tab');

        //general
        $showAdult = ($request->has('show_adult')) ? 1 : 0 ;
        //dd($showAdult);
        //account
        $username = $request->input('name');
        $image = $request->cover;
        $password = $request->input('password');
        $city = $request->input('city');
        $country = $request->input('country');

//        dd($request->hasFile('cover'));


        Debugbar::info($request->all());

        switch ($activeTab){
            case 'general':
                if($user->show_adult != $showAdult){
                    $user->show_adult = $showAdult;
                    $user->save();
                }
                break;
            case 'account':
                if($username) $user->name = $username;
                if($image) {
                    $storage = Storage::disk('s3');
                    $imageName = time().'.'.$image->getClientOriginalExtension();
                    $dirThumb = '/avatars/';
                    $imgThumb = InterventionImage::make($image)/*
                        ->resize(300, null, function ($constraint) {$constraint->aspectRatio();})
                        ->crop(300, 300)*/;

                    $imgThumb = $imgThumb->stream();
                    $storage->put($dirThumb.$imageName, $imgThumb->__toString(), 'public');

                    $user->image = $imageName;
                }
                if($password) $user->password = bcrypt($password);
                if($city) $user->city = $city;
                if($country) $user->country_id = $country;

                $user->save();
                break;
            case 'notifications':;break;
        }

        return redirect()->back()->with('success', 'Изменения успешно сохранены.');
    }

    public function addToBL(BlockUserRequest $request){
        $usernameToBlockName = 'block_user';
        $usernameToBlock = $request->input($usernameToBlockName);
        $activeTab = $request->input('blacklist');
        $userToBlock = User::where('name', $usernameToBlock)->first();

        if(empty($userToBlock)){
            $bag = $this->addMessageBag($usernameToBlockName, 'Введенный пользователь не существует.');

            return redirect()->back()->with('errors', session()->get('errors', new ViewErrorBag)->put('default', $bag));
        }

        if($userToBlock->hasRole('admin')){
            $bag = $this->addMessageBag($usernameToBlockName, 'Вы не можете добавлять администраторов в черный список.');

            return redirect()->back()->with('errors', session()->get('errors', new ViewErrorBag)->put('default', $bag));
        }

        $userToBlock = $userToBlock->toArray();
        $user = Auth::user();

        if($user->id == $userToBlock['id']){
            $bag = $this->addMessageBag($usernameToBlockName, 'Вы не можете добавить себя в черный список.');

            return redirect()->back()->with('errors', session()->get('errors', new ViewErrorBag)->put('default', $bag));
        }

        if($user->hasInBL($userToBlock['id'])){
            $bag = $this->addMessageBag($usernameToBlockName, 'Введенный пользователь уже есть в Вашем списке.');

            return redirect()->back()->with('errors', session()->get('errors', new ViewErrorBag)->put('default', $bag));
        }

        $user->addToBL($userToBlock['id']);

        return redirect()->back()->with(['user' => $user, 'activeTab' => $activeTab]);
    }

    public function removeFromBL(Request $request){
        $user = Auth::user();
        $blockedUserId = $request->input('user_id');
        $activeTab = $request->input('blacklist');

        $user->removeFromBL($blockedUserId);

        return redirect()->back()->with(['user' => $user, 'activeTab' => $activeTab]);
    }


    public function follow(Request $request){
        $userId = $request->route('id');
        $user = Auth::user();

        $user->follow($userId);

        return redirect()->back();
    }

    public function unfollow(Request $request){
        $userId = $request->route('id');
        $user = Auth::user();

        $user->unfollow($userId);

        return redirect()->back();
    }

    /*
     *
     * @return MessageBag
     *
     * */
    private function addMessageBag($name, $message){
        $bag = new MessageBag();

        $bag->add($name, $message);

        return $bag;
    }

    public function sendActivationLink(Request $request){
        Event::fire(new UserSignedUp($request->user()));

        return view('user.profile', ['activationMailSent' => true]);
    }

    public function activateUser(Request $request){
        $token = $request->input('token');
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
