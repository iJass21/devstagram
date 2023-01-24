<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ImagenController extends Controller
{
    //

    public function store(Request $request)
    {
        //return ("Desde imagen controller");
        //$input = $request->all();
        $imagen = $request->file('file');

        $nombreImagen = Str::uuid() . "." . $imagen->extension();//uuid para un unique id


        return response()->json(['imagen' => $nombreImagen]);


    }

}
