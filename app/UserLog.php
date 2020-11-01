<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $guarded = [];

    public function scopeByUser($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }
}
