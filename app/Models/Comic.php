<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;

class Comic extends BaseModel
{
    use Sluggable;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'cover',
        'adult_content',
        'slug',
        'status_id',
        'created_at'
    ];

    /**
     * Sluggable configuration.
     *
     * @var array
     */
    public function sluggable() {
        return [
            'slug' => [
                'source'         => 'title',
                'separator'      => '-',
                'includeTrashed' => true,
            ]
        ];
    }

    public function status()
    {
        return $this->belongsTo('App\Models\ComicStatus');
    }

    public function volumes()
    {
        return $this->hasMany('App\Models\Volume');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function subscribers()
    {
        return $this->belongsToMany('App\Models\User', 'subscriptions');
    }

     public function genres()
    {
        return $this->belongsToMany('App\Models\Genre');
    }

     public function likes()
    {
        return $this->belongsToMany('App\Models\User', 'likes');
    }

     public function comments()
    {
        return $this->hasMany('App\Models\ComicComment');
    }

     public function extra_covers()
    {
        return $this->hasMany('App\Models\ExtraCover');
    }
}
