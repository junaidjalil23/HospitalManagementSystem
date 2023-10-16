<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'doctors';
    protected $primaryKey = 'doc_id';
    protected $fillable = [
        'doc_name',
        'doc_email',
        'contact',
        'address',
        'password',
        'specialization',
        'license_number',
    ];
    public function hasRole($role)
    {
        return $this->role === $role;
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doc_id', 'doc_id');
    }
    public function availableHours()
    {
        return $this->hasMany(AvailableHour::class, 'doc_id');
    }
}
