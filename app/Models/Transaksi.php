<?php

namespace App\Models;

use App\Models\Mitra;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
        'status',
        'platform',
        'total',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function mitra(){
        return $this->belongsTo(Mitra::class);
    }
}
