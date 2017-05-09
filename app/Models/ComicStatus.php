<?php

namespace App\Models;


class ComicStatus extends BaseModel
{
    protected $fillable = [
        'title',
    ];

     public function comic()
    {
        return $this->hasOne('App\Models\Comic');
    }
}
