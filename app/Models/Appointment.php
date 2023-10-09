<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'appointments';
    protected $primaryKey = 'apt_id';
    // protected $fillable = [
    //     'created_at',
    //     'email',
    //     'contact',
    //     'address',
    //     'password',
    //     'disease',
    // ];

}
