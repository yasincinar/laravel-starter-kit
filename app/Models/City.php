<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    public function user()
    {
        $this->hasMany('App\Models\User');
    }
}
