<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableHour extends Model
{
    use HasFactory;

    protected $table = 'available_hours';
    protected $primaryKey = 'id';

    protected $fillable = [
        'doc_id',
        'start_time',
        'end_time',
        'is_booked',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doc_id', 'doc_id');
    }
}
