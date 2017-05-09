<?php

namespace App\Models;


class Country extends BaseModel
{
    protected $fillable = [
        'name'
    ];

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }
}
