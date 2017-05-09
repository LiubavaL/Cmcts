<?php

namespace App\Models;

class Genre extends BaseModel
{
    protected $fillable = [
        'title',
    ];

     public function comics()
    {
        return $this->belongsToMany('App\Models\Comic');
    }
}
