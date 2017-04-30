<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	protected $fillable = [
        'name',
        'sequence',
        'chapter_id'
    ];

	public function image_comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function chapter()
    {
        return $this->belongsTo('App\Models\Chapter');
    }

}
