<?php

namespace App;


class Discussion extends Model
{
    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function reply ()
    {
        return $this->hasMany(Reply::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
