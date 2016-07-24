<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    public function roles()
    {
        return $this->belongsToMany('App\Item','tagitems','tagId','itemId');
    }
}
