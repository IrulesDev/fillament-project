<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RapotSantri extends Model
{
    /** @use HasFactory<\Database\Factories\RapotSantriFactory> */
    use HasFactory;

    protected $fillable = [
        'santri_id',
        'academy_year',
        'overall_score',
        'strengths',
        'weaknesses'
    ];

    public function santri(){
        return $this->belongsTo(user::class);
    }
}
