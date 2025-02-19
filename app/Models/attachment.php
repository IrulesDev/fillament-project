<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attachment extends Model
{
    /** @use HasFactory<\Database\Factories\AttachmentFactory> */
    use HasFactory;

    protected $fillable = [
        'attachment_name',
        'attachment_path'
    ];

    public function attachment_santri(){
        return $this->hasMany(AttachmentSantri::class);
    }
}
