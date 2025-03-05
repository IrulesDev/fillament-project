<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'no_ktp',
        'nisn',
        'gender',
        'date_of_birth',
        'phone',
        'address',
        'generation',
        'entry_date',
        'graduate_date',
        'status_graduate',
        'kelas_id',
        'departement_id',
        'education_stage_id',
        // 'santri_family_id',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function generateCustomId($role)
    {
        $prefix = strtoupper(substr($role ? 'XX' : $role, 0, 3));
        $prefix = str_pad($prefix, 3, 'X');
        $uniqueId = Str::upper(Str::random(15));

        return $prefix . $uniqueId;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            Log::info($model);
            if (empty($model->id)) {
                do {
                    $id = self::generateCustomId($model->role);
                } while (self::where('id', $id)->exists());

                $model->id = $id;
            }
        });
    }

    public function atendace(){
        return $this->hasMany(Atendance::class);
    }

    public function permission(){
        return $this->hasMany(permission::class);
    }

    public function rapot_santri(){
        return $this->hasOne(RapotSantri::class);
    }

    public function financial_record(){
        return $this->hasOne(FinancialRecord::class);
    }

    public function attachment_santri(){
        return $this->hasOne(AttachmentSantri::class);
    }

    public function kelas_santri(){
        return $this->hasOne(KelasSantri::class, 'user_id');
    }

    public function news(){
        return $this->hasOne(news::class);
    }

    public function assessment(){
        return $this->hasMany(Assessment::class, 'user_id');
    }

    public function family(){
        return $this->hasOne(SantriFamily::class, 'user_id');
    }

    public function kelas(){
        return $this->belongsTo(KelasSantri::class);
    }

    public function program_stage(){
        return $this->belongsTo(ProgramStage::class);
    }

    public function departement(){
        return $this->belongsTo(departement::class);
    }

}