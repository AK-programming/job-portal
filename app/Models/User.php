<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // ✅ Custom table setup
    protected $table = 'users';
    protected $primaryKey = 'UserID'; // Match your database
    public $timestamps = false;       // Since your DB doesn't have created_at/updated_at

    // ✅ Allow mass-assignment of these fields
    protected $fillable = [
        'Name',
        'Email',
        'Password',
        'UserType',
    ];

    // ✅ Hide password when serializing (optional if not using APIs)
    protected $hidden = [
        'Password',
        'remember_token',
    ];
}
