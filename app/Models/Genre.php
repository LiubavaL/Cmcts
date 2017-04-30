<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'title',
    ];

     public function comics()
    {
        return $this->belongsToMany('App\Models\Comic');
    }
}
