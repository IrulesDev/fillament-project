<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activities extends Model
{
    /** @use HasFactory<\Database\Factories\ActivitiesFactory> */
    use HasFactory;
    protected $fillable = [
        'activity_name',
        'actifity_date',
        'is_event',
        'description'
    ];

    public function atendance(){
        return $this->hasMany(Atendance::class);
    }
}
