<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leason extends Model
{
    /** @use HasFactory<\Database\Factories\LeasonFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'kelas_santri_id',
        'description'
    ];

    public function assesment(){
        return $this->hasMany(assessment::class);
    }

    public function kelas_santri(){
        return $this->belongsTo(KelasSantri::class);
    }
}
