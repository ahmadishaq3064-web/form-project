<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class credential extends Authenticatable
{
    use HasApiTokens;
    protected $guarded = [];
    public $timestamps = false;
}
