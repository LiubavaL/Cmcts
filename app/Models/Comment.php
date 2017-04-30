<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
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
