<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class banks extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'no_akun',
        'pemilik_akun',
        'img_qr'
    ];
}
