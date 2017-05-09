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
        'status_id'
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

     public function genres()
    {
        return $this->belongsToMany('App\Models\Genre');
    }

     public function likes()
    {
        return $this->belongsToMany('App\Models\User', 'likes');
    }
}
