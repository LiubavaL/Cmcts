<?php

namespace App\Models;


class Comment extends BaseModel
{
	protected $table = 'image-comments';

    protected $fillable = [
        'content',
        'image_id',
        'uaer_id',
    ];

    public function image()
    {
        return $this->belongsTo('App\Models\Image');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
