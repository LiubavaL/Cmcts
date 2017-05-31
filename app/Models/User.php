<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Debugbar;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'image',
        'city',
        'about',
        'country_id',
        'show_adult',
        'is_verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function comics()
    {
        return $this->hasMany('App\Models\Comic');
    }

    public function hasComic($comic)
    {
        return Auth::id() == $comic->user_id;
    }


    //comic subscriptions
    public function subscriptions()
    {
        return $this->belongsToMany('App\Models\Comic', 'subscriptions');
    }

    public function subscribe($subscription_id)
    {
        return $this->subscriptions()->attach($subscription_id);
    }

    public function unsubscribe($subscription_id)
    {
        return $this->subscriptions()->detach($subscription_id);
    }

    public function hasSubscription($subscription_id)
    {
        foreach($this->subscriptions as $subscription){
            if($subscription->id == $subscription_id){
                return true;
            }
        }
        return false;
    }

    //comic likes
    public function likes()
    {
        return $this->belongsToMany('App\Models\Comic', 'likes');
    }

    public function like($comic_id, $type_id)
    {
        return $this->likes()->attach($comic_id, ['type_id' => $type_id]);
    }

    public function dislike($comic_id)
    {
        return $this->likes()->detach($comic_id);
    }

    public function hasLike($comic_id, $type_id){
        foreach($this->likes as $like){
            if(($like->id == $comic_id) && in_array($like->pivot->type_id, $type_id)){
                return true;
            }
        }
        return false;
    }
    

    //followers
    public function followers()
    {
        return $this->belongsToMany('App\Models\User', 'followers', 'user_id', 'follower_id');
    }

    //following
    public function following()
    {
        return $this->belongsToMany('App\Models\User', 'followers', 'follower_id', 'user_id');
    }

    public function follow($user_id)
    {
        //$this->followers()->attach($user_id);   // start follow user
        $user = User::find($user_id);       // find your user to follow
        $user->followers()->attach($this->id);  // add yourself
    }

    public function unfollow($user_id)
    {
        //$this->followers()->detach($user_id);   // start unfollow user
        $user = User::find($user_id);       // find your user to follow
        $user->followers()->detach($this->id);  // remove yourself
    }

    public function isFollowing($user_id, $auth_id){
        $user = User::find($user_id);

        foreach($user->followers as $follower){
            if($follower->id == $auth_id){
                return true;
            }
        }
        return false;
    }

    //blacklist
    public function blacklist()
    {
        return $this->belongsToMany('App\Models\User', 'blacklist', 'user_id', 'blocked_id');
    }

    public function addToBL($user_id)
    {
        $this->blacklist()->attach($user_id);
    }

    public function removeFromBL($user_id)
    {
        $this->blacklist()->detach($user_id);
    }

    public function hasInBL($user_id)
    {
        foreach($this->blacklist as $blockedUser){
            if($blockedUser->id == $user_id){
                return true;
            }
        }
        return false;
    }

    //page comments
    public function image_comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    //comic comments
    public function comic_comments()
    {
        return $this->hasMany('App\Models\ComicComment');
    }


    //roles
    public function roles(){
        return $this->belongsToMany(('App\Models\Role'));
    }

    public function hasRole($name){
        foreach($this->roles as $role){
            if($role->name == $name){
                return true;
            }
        }
        return false;
    }

    public function assignRole($role){
        return $this->roles()->attach($role);
    }

    public function detachRole($role){
        return $this->roles()->detach($role);
    }

    //country
    public function country(){
        return $this->belongsTo('App\Models\Country');
    }
}
