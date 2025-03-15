<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atendance extends Model
{
    /** @use HasFactory<\Database\Factories\AtendanceFactory> */
    use HasFactory;

    protected $fillable = [
        'santri_id',
        'activity_id',
        'activity',
        'status',
        'date'
    ];

    public function activites(){
        return $this->belongsTo(activities::class, 'activity_id');
    }

    public function santri(){
        return $this->belongsTo(User::class);
    }
}
