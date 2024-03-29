<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function  index() 
    {
        return view('auth.register');
    }

    public function autenticar() 
    {

    }

    public function store(Request $request)
    {
        //dd($request);
        //dd($request->get('username'));

        //Modificar el Request
        $request->request->add(['username' => Str::slug( $request->username)]);

        //Validacion

        $this->validate($request, [
            'name' => 'required|min:5|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6',
        ]);

        //dd('CREANDO USUARIO..');
        //el ::create es equivalente a un user into
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make( $request->password)
        ]);

        //Autenticando un usuario
        /*auth()-> attempt([
            'email' =>$request->email,
            'password' =>$request->password,
        ]);*/

        //otra forma de autenticar, ambas formas son correctas
        auth()->attempt($request->only( 'email', 'password'));

        //redireccionando al usuario
        return redirect()->route('post.index');

    }
}
