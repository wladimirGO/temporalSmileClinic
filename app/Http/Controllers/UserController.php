<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rol;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        

        $users = User::where('name', 'LIKE', "%$request->q%")
        ->orWhere('phone_number', 'LIKE', "%$request->q%")
        ->orWhere('email', 'LIKE', "%$request->q%")->paginate(10);

        
            return Inertia::render('User/Index',compact("users"));
                                  
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Rol::get();
        return Inertia::render('User/Create', compact('roles'));
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
            'dni' => 'required|numeric|unique:users',
            'phone_number' => 'required|numeric|digits_between:10,15',
            'address' => 'required',
            'email' => 'required|email|unique:users',
            'rol_id' => 'required|numeric|min:0',
            'password'=> 'confirmed|min:6'

        ]);

        $password="";
        if($request->password){
            $request['password'] = bcrypt($request->password);
        }

        $user = User::create($request->all());
        $message = "Usuario ".$user->name." ha sido creado"; 
        return redirect()->route('usuarios.index')->with('status',$message);
        /*return redirect()->route('usuarios.edit',$user->id)->with('status','Usuario Creado');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usershow = User::findOrFail($id);
        $usershow['rol'] = Rol::findOrFail($usershow->rol_id);
        return Inertia::render('User/Show', compact('usershow'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Rol::get();
        $usershow = User::findOrFail($id);
        return Inertia::render('User/Edit', compact('usershow','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        
        $request->validate([
            'name' => 'required',
            'dni' => 'required|numeric',
            'phone_number' => 'required|numeric|digits_between:10,15',
            'address' => 'required',
            'email' => 'required|email',
            'rol_id' => 'required|numeric|min:0',
            'password'=> 'confirmed'

        ]);


        if($request->password){
            $request['password'] = bcrypt($request->password);
        }else{
            unset($request['password']);
            unset($request['password_confirmation']);
        }

        $user = User::findOrFail($id);
        $user->update($request->all());
        $message = "Usuario ".$user->name." ha sido Actualizado!!"; 
        //return redirect()->route('usuarios.index');
        return redirect()->route('usuarios.index')->with('status',$message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $message = "Usuario ".$user->name." ha sido Eliminado!!";
        $user->delete();
        
        //return redirect()->route('usuarios.index');
        return redirect()->route('usuarios.index')->with('status',$message);
    }
}
