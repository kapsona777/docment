<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Overview extends Model
{
    protected $fillable=[
        'name','qty','icon','status',
    ];
}
