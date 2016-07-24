<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    public function roles()
    {
        return $this->belongsToMany('App\Tag','tagitems','itemId','tagId');
    }
}
