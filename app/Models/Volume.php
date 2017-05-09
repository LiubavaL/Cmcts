<?php

namespace App\Models;


class Volume extends BaseModel
{
	protected $fillable = [
        'comic_id',
        'title',
        'sequence'
    ];

    public function comic()
    {
        return $this->belongsTo('App\Models\Comic');
    }

    public function chapters()
    {
        return $this->hasMany('App\Models\Chapter');
    }
}
