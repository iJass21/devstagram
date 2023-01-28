<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        //relacion uno es a muchos
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //Metodo que almacena los seguidores de un usuario

    public function followers()
    {
        //relacion ed uno es a muchos, como nos salimos de la convencion con la tabla followers, se debe especificar a que
        //tabla estamos haciendo referencia con la relacion ,en este caso un usuarios tiene muchos seguidores, 
        //tambien se debe especificar las llaves foranreas, pues se debe decir donde encotnrar esas referencias
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }


    //Almacenar los que seguimos

    public function followings()
    {
        //Se cambia el orden porque ahora lo hacemos desde el punto de vista del usuario al que siguen, queremos saber
        //cuantas personas lo siguen, entonces ahora se ve desde otro punto de vista al cambiar el orden de los parametros
        //que le estamos pasando a la relacion
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    //Comprobar si un usuario ya sigue a otro

    public function siguiendo(User $user)
    {
        //este metodo contains retorna si es que en la tabla followers se encuentra lo que se le pasa como parametro, que en
        //este caso es el user_id, es decir, revisa en followers si ya hay un seguidor con esa id
        return $this->followers->contains($user->id);
    }

    

}
