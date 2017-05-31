<?php

namespace App\Models;


class ComicComment extends BaseModel
{
    protected $table = 'comic_comments';

    protected $fillable = [
        'content',
        'comic_id',
        'user_id',
        'created_at',
    ];

    public function comic()
    {
        return $this->belongsTo('App\Models\Comic');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
