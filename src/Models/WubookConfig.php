<?php

namespace AND48\LaravelWubook\Models;

use Illuminate\Database\Eloquent\Model;

class WubookConfig extends Model
{
    protected $fillable = [
        'lcode',
        'token',
    ];
}
