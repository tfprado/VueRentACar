<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
