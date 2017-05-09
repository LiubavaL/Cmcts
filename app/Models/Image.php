<?php

namespace App\Models;

class Image extends BaseModel
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
