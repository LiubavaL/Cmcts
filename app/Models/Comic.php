<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Comic extends Model
{
    use Sluggable;

    protected $fillable = [
        'title',
        'description',
        'cover',
        'adult_content'
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
