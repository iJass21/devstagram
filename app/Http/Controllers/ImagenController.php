<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //

    public function store(Request $request)
    {
        //return ("Desde imagen controller");
        //$input = $request->all();
        /*$imagen = $request->file('file');

        $nombreImagen = Str::uuid() . "." . $imagen->extension();//uuid para un unique id
        //var_dump($nombreImagen);

        $imagenServidor = Image::make($imagen);

        $imagenServidor->fit(1000,1000, null);

        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);*/
        $imagen = $request->file('file');

        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(1000, 1000);

        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen ]);
    }

}
