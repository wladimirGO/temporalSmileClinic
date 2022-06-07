<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Patient;
use App\Models\User;
use App\Models\Treatment;
use App\Models\AppoimentTreatments;
use App\Models\Appointment;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function dashboard(Request $request){

        $initDate = ($request->dateStart)?$request->dateStart:Carbon::createFromFormat('m/d/Y', '01/01/2021')->format('Y-m-d');
        $endDate = ($request->dateEnd)?$request->dateEnd:Carbon::now()->format('Y-m-d');
        $nPatients = Patient::count();
        $nAppointments = Appointment::count();
        $nDentists = User::Where('rol_id', '=', "2")
        ->count();
        $aTs = AppoimentTreatments::groupBy('treatments.id','treatments.name')
                ->selectRaw('count(appoiment_treatments.id) as number_of_treatments, treatments.name')
                ->join('treatments','treatments.id', '=', 'appoiment_treatments.treatment_id')
                ->join('appointments','appointments.id','=', 'appoiment_treatments.appointment_id')
                ->whereBetween('appointments.date',[$initDate,$endDate])
                ->get();
        $st1n= [];
        $st1v =[];
        $cpdn = [];
        $cpdv= [];
        $cPD = Appointment::groupBy('date')
                ->selectRaw('count(id) as number_of_appointment, date')
                ->whereBetween('date',[$initDate,$endDate])
                ->get();

       //return "<code>".$aTs."</code>";
        foreach ($aTs as $key => $aT) {
            array_push($st1v,$aT->number_of_treatments);
            array_push($st1n,$aT->name);
        }

        foreach ($cPD as $key => $value) {
            array_push($cpdv,$value->number_of_appointment);
            array_push($cpdn,$value->date);
        }

        //return $st1n;
        return Inertia::render('Dashboard',compact("nPatients","nDentists","nAppointments","st1n","st1v","cpdv","cpdn","initDate", "endDate"));

    }

    public function calculator(){

        $treatments = Treatment::all();
        return Inertia::render('Calculator/Index', compact('treatments'));
    }
}
