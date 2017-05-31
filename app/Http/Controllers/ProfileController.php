<?php

namespace App\Http\Controllers;

use App\Notifications\NewFollower;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateSettingsRequest;
use App\Http\Requests\BlockUserRequest;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\MessageBag;
use App\Models\Comic;
use App\Models\User;
use App\Models\Country;
use App\Models\ConfirmUsers;
use Auth;
use Debugbar;
use Validator;
use Event;
use App\Events\UserSignedUp;
use App\Services\ComicService;

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
    public function showProfile(Request $request, ComicService $comicService)
    {
        $userId = $request->route('id');
        $user = null;
        $authUser = Auth::user();
        $isFollowing = false;
        $isSelfProfile = false;

        if($userId){
            $user = User::where('id', $userId)->first();
            $isFollowing = $authUser->isFollowing($user->id, $authUser->id);
        }else{
            $user = $authUser;
            $isSelfProfile = true;
        }

        $user->load('followers', 'following','subscriptions', 'likes');

        $comics = Comic::with('status','genres')->withCount('comments')->where('user_id', $user->id)->get();
        //$comics = Comic::with('volumes.chapters.images')->where('user_id', Auth::id())->get();


        $comics = $comicService->getSubscriptionsForComics($comics);
        $comics = $comicService->getCommentsForComics($comics);
        $comics = $comicService->getPageviewsForComics($comics);

        $followers = $user->followers->count();
        $following = $user->following->count();

        return view('user.profile', [
            'user' => $user,
            'comics' => $comics,
            'followers' => $followers,
            'following' => $following,
            'isFollowing' => $isFollowing,
            'isSelfProfile' => $isSelfProfile
        ]);
    }

    public function showFollowers(Request $request){
        $userId = $request->route('id', Auth::id());

        //получаем авт юзера с привязанным списком подписчиков
        $user = User::with(['followers' => function ($query) use ($userId){
            $query->where('user_id', $userId);
        }])->where('id', $userId)->first();
        //оставляем только список подписчиков
        //$followers = $followers->first();

        return view('user.follow.followers', [
            'user' => $user
        ]);
    }

    public function showFollowing(Request $request){
        $userId = $request->route('id', Auth::id());

        //получаем авт юзера с привязанным списком подписчиков
        $user = User::with(['following' => function ($query) use ($userId){
            $query->where('follower_id', $userId);
        }])->where('id', $userId)->first();

        //оставляем только список людей, на которых подписан
        //$following = $following->first()->following->toArray();


        return view('user.follow.following', [
            'user' => $user
        ]);
    }

    public function showNotifications(){
        $user = Auth::user();
        //dd($user->notifications->first()->data['follower_id']);

        return view('user.notifications.notifications', [
            'user' => $user
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

    public function postSettings(UpdateSettingsRequest $request, ProfileService $profileService)
    {
        $user = Auth::user();
        $activeTab = $request->input('tab');

        //general
        $showAdult = ($request->has('show_adult')) ? 1 : 0 ;
        $email = $request->email;
        //dd($showAdult);
        //account
        $username = $request->input('name');
        $about = $request->about;
        $image = $request->avatar;
        $password = $request->input('password');
        $city = $request->input('city');
        $country = $request->input('country');

//        dd($request->hasFile('cover'));


        switch ($activeTab){
            case 'general':
                if($user->email != $email){
                    $user->email = $email;
                    $user->is_verified = 0;
                    $user->save();
                    $this->sendActivationLink($request);
                }
                if($user->show_adult != $showAdult){
                    $user->show_adult = $showAdult;
                    $user->save();
                }
                break;
            case 'account':
                if($username) $user->name = $username;
                if($image) {
                    $imageName = $profileService->putAvatar($image);
                    $user->image = $imageName;
                }
                if($password) $user->password = bcrypt($password);
                if($about) $user->about = $about;
                if($city) $user->city = $city;
                if($country) $user->country_id = $country;

                $user->save();
                break;
            case 'notifications':;break;
        }

        return redirect()->back()->with('success', 'Changes saved.');
    }

    /*
     *
     * blacklist
     *
     */
    public function addToBL(BlockUserRequest $request){
        $usernameToBlockName = 'block_user';
        $usernameToBlock = $request->input($usernameToBlockName);
        $activeTab = $request->input('blacklist');
        $userToBlock = User::where('name', $usernameToBlock)->first();

        if(empty($userToBlock)){
            $bag = $this->addMessageBag($usernameToBlockName, 'User doesn\'t exist.');

            return redirect()->back()->with('errors', session()->get('errors', new ViewErrorBag)->put('default', $bag));
        }

        if($userToBlock->hasRole('admin')){
            $bag = $this->addMessageBag($usernameToBlockName, 'You can\'t add administrator to blacklist.');

            return redirect()->back()->with('errors', session()->get('errors', new ViewErrorBag)->put('default', $bag));
        }

        $userToBlock = $userToBlock->toArray();
        $user = Auth::user();

        if($user->id == $userToBlock['id']){
            $bag = $this->addMessageBag($usernameToBlockName, 'You can\'t add yourself to blacklist.');

            return redirect()->back()->with('errors', session()->get('errors', new ViewErrorBag)->put('default', $bag));
        }

        if($user->hasInBL($userToBlock['id'])){
            $bag = $this->addMessageBag($usernameToBlockName, 'This user was already been saved to you list.');

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

    /*
     *
     * follow/unfollow
     *
     */
    public function follow(Request $request){
        $userId = $request->route('id');
        $user = Auth::user();

        $user->follow($userId);

        //notify user about new follower
        $followed = User::where('id', $userId)->first();
        $followed->notify(new NewFollower($user));

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

    /*
     *
     * User Account Activation
     *
     * */
    public function sendActivationLink(Request $request){
        Event::fire(new UserSignedUp($request->user()));
        $request->session()->flash('activationMailSent', true);

        //return redirect()->back()->with('activationMailSent', true);
    }

    public function getSendActivationLink(Request $request){
        $this->sendActivationLink($request);

        return redirect()->back();
    }

    public function activateUser(Request $request){
        $token = $request->route('token');
        $activated = false;
        $confirmation = $this->getActivation($token);


        if($confirmation){
            $user = User::where('email', $confirmation->email)->first();
            $user->is_verified = true;
            $user->save();

            if($user){
                $this->removeActivation($confirmation);
                $activated = true;
            }
        }

        return redirect('/settings/general')->with('activated', $activated);
    }

    private function getActivation($token){
        $confirmUser = ConfirmUsers::where('token', $token)->first();
        return $confirmUser;
    }

    private function removeActivation($confirmation){
        $confirmation->delete();
    }
}
