<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    /** @use HasFactory<\Database\Factories\DepartementFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'leader_id',
        'co_leader_id' 
    ];

    public function user(){
        return $this->hasMany(User::class);
    }

    public function leader(){
        return $this->belongsTo(user::class);
    }

    public function co_leader(){
        return $this->belongsTo(user::class);
    }
}
