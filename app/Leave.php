<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable=[
        'doctor_id','date','status',
    ];
}
