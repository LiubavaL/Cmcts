<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = [
        'volume_id',
        'title',
        'sequence'
    ];

    public function volume()
    {
        return $this->belongsTo('App\Models\Volume');
    }

    public function images()
    {
        return $this->hasMany('App\Models\Image');
    }
}
