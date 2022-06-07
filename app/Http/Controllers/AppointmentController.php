<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AppoimentTreatments;
use Illuminate\Http\Request;
use App\Models\Treatment;
use App\Models\User;
use App\Models\Patient;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $myString = $request->aux;
        $myArray = explode('.', $myString);
        
            if(count($myArray)>1){
                if(auth()->user()->id!=1){
                    //Es Doctor
                    $appointments=Appointment::join("users","users.id","=","appointments.user_id")
                    ->join("patients","patients.id","=","appointments.patient_id")
                    ->where([
                        ['users.id', '=', auth()->user()->id],
                        ['patients.name', 'LIKE', "%$myArray[0]%"],
                        ['appointments.date', 'LIKE', "%$myArray[1]%"],
                    ])
                    ->orWhere([
                        ['users.id', '=', auth()->user()->id],
                        ['patients.dni', 'LIKE', "%$myArray[0]%"],
                        ['appointments.date', 'LIKE', "%$myArray[1]%"],
                    ])
                    ->select('appointments.id','date','hour','users.name as doctor','patients.name as paciente')
                    ->paginate(7);
                }
                else{
                    //Es Admin
                    $appointments=Appointment::join("users","users.id","=","appointments.user_id")
                    ->join("patients","patients.id","=","appointments.patient_id")
                    ->where([
                        ['patients.name', 'LIKE', "%$myArray[0]%"],
                        ['appointments.date', 'LIKE', "%$myArray[1]%"],
                    ])
                    ->orWhere([
                        ['patients.dni', 'LIKE', "%$myArray[0]%"],
                        ['appointments.date', 'LIKE', "%$myArray[1]%"],
                    ])
                    ->orWhere([
                        ['users.name', 'LIKE', "%$myArray[0]%"],
                        ['appointments.date', 'LIKE', "%$myArray[1]%"],
                    ])
                    ->orWhere([
                        ['users.dni', 'LIKE', "%$myArray[0]%"],
                        ['appointments.date', 'LIKE', "%$myArray[1]%"],
                    ])
                    ->select('appointments.id','date','hour','users.name as doctor','patients.name as paciente')
                    ->paginate(7);
                }
                
            }
            else{
                if(auth()->user()->id!=1){
                    //Es doctor
                    $appointments=Appointment::join("users","users.id","=","appointments.user_id")
                    ->join("patients","patients.id","=","appointments.patient_id")
                    ->where([
                        ['users.id', '=', auth()->user()->id]
                    ])
                    ->select('appointments.id','date','hour','users.name as doctor','patients.name as paciente')
                    ->paginate(7);
                }
                else{
                    //es Admin
                    
                    $appointments=Appointment::join("users","users.id","=","appointments.user_id")
                    ->join("patients","patients.id","=","appointments.patient_id")
                    ->select('appointments.id','date','hour','users.name as doctor','patients.name as paciente')
                    ->paginate(7);
                }
                
            }
            
        
      
       
        return Inertia::render('Appointment/Index',compact("appointments"));

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = Patient::get();

        $doctors = User::where('rol_id','=','2')
        ->get();

        $treatments= Treatment::get();

        $currentDate = Carbon::now()->toDateString();
       return Inertia::render('Appointment/Create', compact('patients','doctors','treatments','currentDate'));

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'time' => 'required',
            'patient_id' => 'required|numeric',
            'doctor_id' => 'required',
            'total' => 'required|numeric',
            'list' => 'required'
        ]);

        $cita=0;
        $cita = Appointment::
        where('user_id','=',$request->get('doctor_id'))
        ->whereDate('date',$request->get('date'))
        ->whereTime('hour',$request->get('time'))
        ->select('user_id')
        ->get();
        if(count($cita)>0){
            $message="El doctor ya tiene una cita asignada en ese horario";
            return redirect()->back()->with('status',$message);
        }
        else{
            $appointment = New Appointment();
            $appointment->date=$request->get('date');
            $appointment->hour=$request->get('time');
            $appointment->patient_id=$request->get('patient_id');
            $appointment->user_id=$request->get('doctor_id');
            $appointment->total=$request->get('total');
            $appointment->save();

            $aux=$request->get('list');

            $cont=0;
            
            while ($cont < count($aux)) {
            
                $appointmentTrea= new AppoimentTreatments();
                $appointmentTrea->appointment_id=$appointment->id;
                $appointmentTrea->treatment_id=$aux[$cont]['treatment_id'];
                $appointmentTrea->amount=$aux[$cont]['amount'];
                $appointmentTrea->count=$aux[$cont]['count'];
                $appointmentTrea->save();
            
                $cont++;
            }
            $message = "La cita ha sido creado"; 
            return redirect()->route('citas.index')->with('status',$message);
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment['doctor'] = User::findOrFail($appointment->user_id);
        $appointment['patient'] = Patient::findOrFail($appointment->patient_id);
        $appointment['status'] = Status::findOrFail($appointment->status_id);

        $appTrea=  AppoimentTreatments
        ::join("treatments","treatments.id","=","treatment_id")
        ->select('treatments.id as treatment_id','treatments.name as treatment_name','amount','count')
        ->where("appointment_id","=",$id)
        ->get();

        return Inertia::render('Appointment/Show', compact('appointment','appTrea'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patients = Patient::get();

        $doctors = User::where('rol_id','=','2')
        ->get();

        $treatments= Treatment::get();
        $status= Status::get();


        $appointment=Appointment::findOrFail($id);

        $appTreat=AppoimentTreatments::
        join("treatments","treatments.id","=","treatment_id")
        ->select('treatments.id as treatment_id','treatments.name as treatment_name','amount','count')
        ->where("appointment_id","=",$id)
        ->get();
        
        
        return Inertia::render('Appointment/Edit', compact('patients','doctors','treatments','status','appointment','appTreat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required',
            'time' => 'required',
            'patient_id' => 'required|numeric',
            'doctor_id' => 'required',
            'status_id' => 'required',
            'total' => 'required|numeric',
            'list' => 'required'
        ]);

        $cita=0;
        $cita = Appointment::
        where('user_id','=',$request->get('doctor_id'))
        ->whereDate('date',$request->get('date'))
        ->whereTime('hour',$request->get('time'))
        ->select('user_id')
        ->get();
        if(count($cita)>0){
            $message="El doctor ya tiene una cita asignada en ese horario";
            return redirect()->back()->with('status',$message);
        }
        else{
            $appointment = Appointment::findOrFail($id);
            $appointment->date=$request->get('date');
            $appointment->hour=$request->get('time');
            $appointment->status_id=$request->get('status_id');
            $appointment->patient_id=$request->get('patient_id');
            $appointment->user_id=$request->get('doctor_id');
            $appointment->total=$request->get('total');
            $appointment->update();

            $aux=$request->get('list');

            $appointmentTrea=AppoimentTreatments::
            where("appointment_id","=",$id)
            ->get();

            $appointmentTrea->each->delete();

            $cont=0;
            while ($cont < count($aux)) {
                if($aux[$cont]['count']>0){
                    $appointmentTrea= new AppoimentTreatments();
                    $appointmentTrea->appointment_id=$appointment->id;
                    $appointmentTrea->treatment_id=$aux[$cont]['treatment_id'];
                    $appointmentTrea->amount=$aux[$cont]['amount'];
                    $appointmentTrea->count=$aux[$cont]['count'];
                    $appointmentTrea->save();
                }
                $cont++;
            }
            $message = "La Cita ha sido Actualizada!!"; 
            return redirect()->route('citas.index')->with('status',$message);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointmentTrea= AppoimentTreatments::
        where("appointment_id","=",$id)
        ->get();

        $appointment= Appointment::findOrFail($id);

        $message = "La Cita ha sido Eliminada!!";
      
        $appointmentTrea->each->delete();
        $appointment->delete();

        return redirect()->route('citas.index')->with('status',$message);
    }
}
