<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //
    public function store(Request $request, Post $post)
    {
        //No hay validacion porque obviamente va a ser un click
        //dd($request->user()->id);
        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        //nos regresa al mismo post
        return back();
    }

    public function destroy(Request $request, Post $post)
    {
        //dd('Eliminando like');
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }



}
