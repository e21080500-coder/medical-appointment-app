<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [

        'patient_id',
        'doctor_id',

        'appointment_date',

        'start_time',
        'end_time',

        'status',

        'reason',

        'symptoms',
        'diagnosis',
        'treatment',
        'notes',
    ];

    /**
     * Relación paciente
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Relación doctor
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}