<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasSantri extends Model
{
    /** @use HasFactory<\Database\Factories\KelasSantriFactory> */
    use HasFactory;

    protected $fillable = [
        'major',
        'mentor_id'
    ];

    public function mentor(){
        return $this->belongsTo(user::class);
    }

    public function santri(){
        return $this->hasMany(User::class);
    }

    public function leason(){
        return $this->hasMany(Leason::class);
    }
}
