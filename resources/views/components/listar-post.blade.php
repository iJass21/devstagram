<div>
    <!-- Order your soul. Reduce your wants. - Augustine -->
    
    @if($posts->count())

        <div class=" grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <div>
                    <a href=" {{ route('posts.show', ['post' => $post, 'user' => $post->user]) }} ">
                        <img src="{{ asset('uploads') .'/' . $post->imagen}}" alt="Imagen del post {{$post->titulo}}">
                    </a>
                </div>            
            @endforeach
        </div>
        
        <div class=" my-10">
            <!-- Esto es para que ponga automaticamente la paginacion-->
            {{$posts->links()}}
        </div>

    @else
        <p class=" text-center">No hay posts, sigue a alguien para poder ver contenido</p>
    @endif

</div>