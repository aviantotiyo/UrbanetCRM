<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids, SoftDeletes;

    /**
     * Primary key bukan auto-increment, melainkan UUID string.
     */
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Kolom yang bisa diisi massal.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'active',
        'is_first_login',
        'email_verified_at',
        'deleted_at',
        'remember_token'
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Konversi atribut ke tipe data native.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'active' => 'boolean',
        'is_first_login' => 'boolean',
    ];
}
