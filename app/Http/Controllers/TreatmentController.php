<?php

namespace App\Http\Controllers;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class TreatmentController extends Controller
{
    public function index(request $request)
    {
        $treatments = Treatment::where('name', 'LIKE', "%$request->q%")
        ->orWhere('description', 'LIKE', "%$request->q%")->paginate(11);

        return Inertia::render('Treatment/Index',compact("treatments"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Treatment/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$request->validate([
            'name' => 'required',
            'dni' => 'required|numeric|unique:patients',
            'phone_number' => 'required|numeric|digits_between:10,15',
            'address' => 'required',
        ]);
        $patient = Patient::create($request->all());
        $message = "Paciente ".$patient->name." ha sido creado"; 
        return redirect()->route('pacientes.index')->with('status',$message);*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $treatment = Treatment::findOrFail($id);
        return Inertia::render('Treatment/Show', compact('treatment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $treatment = Treatment::findOrFail($id);
        return Inertia::render('Treatment/Edit', compact('treatment'));
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
        $treatment = Treatment::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);


        $treatment = Treatment::findOrFail($id);
        $treatment->update($request->all());
        $message = "Tratamiento ".$treatment->name." ha sido Actualizado!"; 
        return redirect()->route('tratamientos.index')->with('status',$message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       /* $patient = Patient::findOrFail($id);
        $message = "Paciente ".$patient->name." ha sido Eliminado!"; 
        $patient->delete();
        return redirect()->route('pacientes.index')->with('status',$message);*/
    }
}


