<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class credential extends Authenticatable
{
    use HasApiTokens;
    protected $guarded = [];
    public $timestamps = false;
}
