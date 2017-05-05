<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Role;
use Validator;
use Auth;
use App\Models\ConfirmUsers;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(Request $request, array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        if($user){
            $userRole = Role::whereName('user')->first();
            $user->assignRole($userRole);

            $this->sendActivationLink($request, $user);

            return $user;
        }else new \Exception("Failed to create user");
    }

    public function sendActivationLink(Request $request, $user = null){
        if(empty($user)){
            $user = Auth::user();
        }

        $activationLink = $this->addActivation($user);

        Mail::to($request->user())->send(new UserRegistered($activationLink));
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

    private function addActivation($user){
        $confirmation = new ConfirmUsers;

        $confirmation->token = str_random(32);
        $confirmation->email = $user->email;
        $confirmation->save();

        $activationLink = 'http://comicats.herokuapp.com/activate/'.$confirmation->token;

        return $activationLink;
    }

    private function getActivation($token){
        return ConfirmUsers::find('token', $token);
    }

    private function removeActivation($confirmation){
        $confirmation->delete();
    }
}
