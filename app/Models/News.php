<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /** @use HasFactory<\Database\Factories\NewsFactory> */
    use HasFactory;

    protected $fillable = [
        'autor_id',
        'gambar',
        'title',
        'content'
    ];

    protected $casts = [
        'attachments' => 'array',
    ];

    public function autor(){
        return $this->belongsTo(User::class);
    }
}
