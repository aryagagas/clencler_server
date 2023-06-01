<?php

namespace App\Models;

use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Mitra extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $guard = 'mitra';
    protected $fillable = [
        'name', 'email', 'password',
    ];
    public function transaksi(){
        return $this->hasMany(Transaksi::class);
    }
}
