<?php

namespace App\Models;


class ComicComment extends BaseModel
{
    protected $table = 'comic-comments';

    protected $fillable = [
        'content',
        'comic_id',
        'uaer_id',
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
