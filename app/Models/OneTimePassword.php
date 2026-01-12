<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OneTimePassword extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_type',
        'entity_id',
        'code',
        'email',
        'phone',
        'type',
        'is_verified',
        'expiry_time',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'expiry_time' => 'datetime',
    ];

    /**
     * Relasi polymorphic ke user atau entitas lain
     */
    public function entity()
    {
        return $this->morphTo();
    }

    /**
     * Generate dan simpan OTP baru untuk entity
     */
    public static function generate($entity, $type = 'Login', $length = 4, $expireMinutes = 5)
    {
        // Hapus OTP lama yang belum diverifikasi
        static::where('entity_type', get_class($entity))
            ->where('entity_id', $entity->id)
            ->where('type', $type)
            ->where('is_verified', 0)
            ->delete();

        // Karakter yang digunakan (tanpa huruf ambigu)
        // $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ123456789';
        $characters = '0123456789';
        $otpCode = '';
        for ($i = 0; $i < $length; $i++) {
            $otpCode .= $characters[random_int(0, strlen($characters) - 1)];
        }

        // Ambil email & phone dari relasi (jika ada)
        $email = $entity->email ?? null;
        $phone = $entity->phone ?? null;

        // Simpan OTP baru
        return static::create([
            'entity_type' => get_class($entity),
            'entity_id'   => $entity->id,
            'type'        => $type,
            'code'        => $otpCode,
            'email'       => $email,
            'phone'       => $phone,
            'is_verified' => false,
            'expiry_time' => now()->addMinutes($expireMinutes),
            'created_by'  => 'system',
        ]);
    }
}
