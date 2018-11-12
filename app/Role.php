<?php

namespace SCB;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
        return $this
            ->belongsToMany('SCB\User')
            ->withTimestamps();
    }
}
