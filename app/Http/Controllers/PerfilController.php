<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //dd('Aqui va el formulario de editar');
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        //dd('guardando cambios');

        $request->request->add(['username' => Str::slug( $request->username)]);
        //dd($request->username);

        $this->validate($request, [
            //Si son mas de 3 reglas se recomienda pasarlo en forma de arreglo
            //el not in es como una lista negra de valores que no puede tomar la palabra, el in es para que pueda elegir de una lsita
            'username' => [ 'required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil'],
        ]);

        if($request->imagen)
        {
            //dd('Si hay imagen');
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . "." . $imagen->extension();
    
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);
    
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        //guardar cambios

        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;

        $usuario->save();

        //Redireccionando
        return redirect()->route('posts.index', $usuario->username);

    }

}
