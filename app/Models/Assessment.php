<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    /** @use HasFactory<\Database\Factories\AssessmentFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lesson_id',
        'score',
        'evaluation',
        'date'
    ];

    public function santri(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lessons(){
        return $this->belongsTo(Leason::class, 'lesson_id');
    }
}
