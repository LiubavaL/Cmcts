<?php

namespace App\Models;


class ConfirmUsers extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'email',
        'token'
    ];
}
