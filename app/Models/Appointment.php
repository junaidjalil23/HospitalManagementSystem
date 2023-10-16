<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'appointments';
    protected $primaryKey = 'apt_id';
    protected $fillable = [
        'department',
        'description',
        'patient_id',
        'doc_id',
        'appointment_date',
    ];
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id', 'patient_id');
    }
    
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doc_id', 'doc_id');
    }
}
