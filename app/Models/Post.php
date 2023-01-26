<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Comentario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user()//relaciones de laravel, post pertenese a usuario
    {
        return $this->belongsTo(User::class)->select('name', 'username');
    }

    public function comentarios()
    {//recordemos que esto es para definir la relacion, y asi poder usar la informacion de la tabla comentarios en post
        //un post tiene muchos comentarios

        return $this->hasMany(Comentario::class);
    }

    public function likes()
    {
        //un post tiene muchos likes, por eso en la tabla de post se le pone hasmany en likes
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }


}
