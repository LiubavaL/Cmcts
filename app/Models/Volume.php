<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volume extends Model
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
