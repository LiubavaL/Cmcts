<?php

namespace App;

class Social extends BaseModel
{
    protected $table = 'social_logins';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
