<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        //dd(auth() ->user());
        
        //automaticamkente se situa en la tabla post
        //paginate() es similar al get, pero solo muestra la cantidad de elementos que le pase como parametro,
        //los otros los muestra en la siguiente pagina, hay que añadir los numeritos en el .blade
        $posts = Post::where('user_id', $user->id)->paginate(20);

        

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request) 
    {
        //dd('Creando publication');
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        //forma 1:
   /*     Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);*/

        //Otra forma:

        /*$post = new Post;
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id= auth()->user()->id;
        $post->save();//es necesario el save, el anterior lo hace automatico*/

        //Tercera forma: Mas al estilo de laravel

        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);
        
        return redirect()->route('posts.index', auth()->user()->username );

    }

    public function show(User $user, Post $post) 
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }



}
