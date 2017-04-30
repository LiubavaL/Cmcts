<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComicStatus extends Model
{
    protected $fillable = [
        'title',
    ];

     public function comic()
    {
        return $this->hasOne('App\Models\Comic');
    }
}
