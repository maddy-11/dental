<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PrescriptionMedicine;
use App\Models\Appointment;

class Prescription extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'details' => 'array',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function medicine()
    {
        return $this->belongsTo(PrescriptionMedicine::class, 'medicine_id');
    }
}
