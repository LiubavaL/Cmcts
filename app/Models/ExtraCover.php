<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtraCover extends BaseModel
{
    protected $table = 'extra-covers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comic_id',
        'image',
    ];
}
