<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assessment extends Model
{
    /** @use HasFactory<\Database\Factories\AssessmentFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'leason_id',
        'score',
        'evaluation',
        'date'
    ];

    public function santri(){
        return $this->belongsTo(User::class);
    }

    public function lessons(){
        return $this->belongsTo(Leason::class);
    }
}
