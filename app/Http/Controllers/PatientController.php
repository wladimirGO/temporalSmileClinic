<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
   

        $patients = Patient::where('name', 'LIKE', "%$request->q%")
        ->orWhere('phone_number', 'LIKE', "%$request->q%")
        ->orWhere('dni', 'LIKE', "%$request->q%")->paginate(11);

        return Inertia::render('Patient/Index',compact("patients"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Patient/Create');
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
            'name' => 'required',
            'dni' => 'required|numeric|unique:patients',
            'phone_number' => 'required|numeric|digits_between:10,15',
            'address' => 'required',
        ]);
        $patient = Patient::create($request->all());
        $message = "Paciente ".$patient->name." ha sido creado"; 
        return redirect()->route('pacientes.index')->with('status',$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        return Inertia::render('Patient/Show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return Inertia::render('Patient/Edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'dni' => 'required|numeric',
            'phone_number' => 'required|numeric|digits_between:10,15',
            'address' => 'required'

        ]);


        $patient = Patient::findOrFail($id);
        $patient->update($request->all());
        $message = "Paciente ".$patient->name." ha sido Actualizado!"; 
        return redirect()->route('pacientes.index')->with('status',$message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $message = "Paciente ".$patient->name." ha sido Eliminado!"; 
        $patient->delete();
        return redirect()->route('pacientes.index')->with('status',$message);
    }
}
