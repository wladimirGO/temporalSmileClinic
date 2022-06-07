<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'hour',
        'date',
        'total',
        'patient_id',
        'status_id',
        'user_id'
    ];
}
