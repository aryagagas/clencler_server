<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Sanctum\HasApiTokens;

// class Mitra extends Model implements Authenticatable
class Mitra extends Authenticatable
{
    // use \Illuminate\Auth\Authenticatable;
    use HasFactory, HasApiTokens;

    protected $guard = 'mitra';
    protected $fillable = [
        'name', 'email', 'password',
    ];
}
