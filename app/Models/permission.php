<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    /** @use HasFactory<\Database\Factories\PermissionFactory> */
    use HasFactory;

    protected $fillable = [
        'reason',
        'user_id',
        'status',
        'start_date',
        'end_date'
    ];

    public function santri(){
        return $this->belongsTo(user::class);
    }
}
