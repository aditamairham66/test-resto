<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * Kolom yang boleh diisi mass-assignment.
     */
    protected $fillable = [
        'username',
        'name',
        'image',
        'phone',
        'email',
        'password',
        'group',
        'status',
        'is_send_whatsapp',
        'is_send_email',
        'last_login',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting kolom ke tipe data tertentu.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login' => 'datetime',
        'password' => 'hashed',
        'status' => 'integer',
        'is_send_whatsapp' => 'boolean',
        'is_send_email' => 'boolean',
        'group' => 'integer',
    ];

    /**
     * Default nilai kolom tertentu.
     */
    protected $attributes = [
        'is_send_whatsapp' => 1,
        'is_send_email' => 1,
    ];

    /**
     * Relation
     **/
    public function otp()
    {
        return $this->morphMany(OneTimePassword::class, 'entity');
    }
}
