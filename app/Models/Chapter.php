<?php

namespace App\Models;

class Chapter extends BaseModel
{
    protected $fillable = [
        'volume_id',
        'title',
        'sequence',
        'created_at'
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
