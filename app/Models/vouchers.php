<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vouchers extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'type',
        'persentase',
        'nominal',
        'jumlah',
        'berlaku_sampai'
    ];
}
