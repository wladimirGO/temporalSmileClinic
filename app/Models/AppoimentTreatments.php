<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppoimentTreatments extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'count',
        'treatment_id',
        'appointment_id'
    ];

    public function Treatments(){
        return $this->hasMany('App\Models\Treatments','treatment_id')->selectRaw('treatments.*,count(id) as count_treatment')->groupBy('treatment_id');
     }
}
