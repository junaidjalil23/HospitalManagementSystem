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

}
