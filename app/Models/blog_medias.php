<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blog_medias extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_id',
        'media'
    ];

    public function blogs()
    {
        return $this->belongsTo(blogs::class);
    }
}
