<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class credential extends Authenticatable
{
    protected $guarded = [];
    public $timestamps = false;
}
