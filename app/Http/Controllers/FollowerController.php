<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //
    public function store(User $user)
    {
        //attach se recomienda cuando tenemos relacion de muchos a muchos, y no estamos utilizando el modelo directamente
        //como ambas id pertenecen a la misma tabla, se debe usar attach, relacionando con la misma tabla, si no se usa create
        $user->followers()->attach(auth()->user()->id );
        return back();

    }

    public function destroy(User $user)
    {
        //dd('dando unfollow');
        $user->followers()->detach(auth()->user()->id);
        return back();
    }


}
