<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    //Es un metodo invocable, es decir, el metodo se manda a llamar automaticamente, es como un constructor
    public function __invoke()
    {
        //obtener a queines seguimos

        $ids = auth()->user()->followings->pluck('id')->toArray();
        //where solo filta un valor, whereIn puede filtrar con un arreglo
        //En vez de paginate se podria usar get para que los muestre todos, o paginate para que haga la paginacion
        //el latest es para que muestre lo mas reciente primero
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);

        
        return view('home',
        [
            'posts' => $posts,
        ]);
    }
}
