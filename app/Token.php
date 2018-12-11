<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Token extends Model
{
    use SoftDeletes;

    protected $fillable =[
            'access_token','device_id','device_type','user_id'
    ];

    protected $hidden = ['deleted_at'];

    protected $dates = ['deleted_at'];
}
