<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'patient_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // public function isAdmin()
    // {
    //     return $this->role === 'admin';
    // }
     protected $fillable = [
        'patient_name',
        'email',
        'contact',
        'address',
        'password',
        'disease',
    ];
    public function hasRole($role)
    {
        // Check if the user has the given role
        return $this->role === $role;
    }
    public function appointment()
    {
        return $this->hasOne(Appointment::class, 'patient_id', 'patient_id');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
