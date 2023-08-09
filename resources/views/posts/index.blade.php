@extends('layouts.app')

@section('titulo', 'Dashboard')

@section('contenido')
    <div class="p-6 text-gray-900">
        <!-- component -->
        <!-- This is an example component -->
        <div class="bg-white overflow-hidden shadow-none">
            <div class="grid grid-cols-3 min-w-full">

                <div class="col-span-2 w-full">
                    <img class="w-full max-w-full min-w-full"
                        src="https://images.pexels.com/photos/747964/pexels-photo-747964.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260"
                        alt="Description">
                </div>

                <div class="col-span-1 relative pl-4">
                    <header class="border-b border-grey-400">
                        <a href="#" class="cursor-pointer py-4 flex items-center text-sm outline-none focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                            <img src="https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260" class="h-9 w-9 rounded-full object-cover"
                            alt="user" />
                            <p class="block ml-2 font-bold">Paul</p>
                        </a>
                    </header>
                    <ul class="mt-3 flex gap-1 flex-col" id="comments">
                        {{-- * Comentarios insertados con Axios --}}
                    </ul>

                    <div class="absolute bottom-0 left-0 right-0 pl-4">
                        <div class="pt-4">
                            <div class="mb-2">
                                <div class="flex items-center">
                                    <span class="mr-3 inline-flex items-center cursor-pointer">
                                        <svg class="fill-heart text-gray-700 inline-block h-7 w-7 heart" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </span>
                                    <span class="mr-3 inline-flex items-center cursor-pointer">
                                        <svg class="text-gray-700 inline-block h-7 w-7 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                    </span>
                                </div>
                                <span class="text-gray-600 text-sm font-bold">2344 Likes</span>
                            </div>
                            <span class="block ml-2 text-xs text-gray-600">5 minutes</span>
                        </div>

                        <form>
                            <div class="pt-4 pb-1 pr-3">
                                <div class="flex items-center">
                                    <input id="comment" class="w-full resize-none !outline-none appearance-none border-none !shadow-none !ring-transparent" aria-label="Agrega un comentario..." placeholder="Agrega un comentario..."  autocomplete="off" autocorrect="off" style="height: 36px;"></input>
                                    <button id="send" class="focus:outline-none border-none bg-transparent text-sky-600 font-bold">Publicar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    {{-- Estilos adicionales --}}
@endpush

@push('scripts')
    {{-- Scripts adicionales --}}
    <script>
        const userId   = `{{ auth()->id() }}`;
        const userName = `{{ auth()->user()->name }}`;
        $(document).ready(function () {
            // Recibimos los comentarios usando axios
            axios.get('{{ route('api.comentarios.index') }}')
                .then(function (response) {
                    // Recorremos los comentarios
                    response.data.forEach(function (comment) {
                        // Agregamos el comentario
                        addComment( comment.user.name, comment.comentario );
                    });
                })
                .catch(function (error) {
                    console.log(error);
                });
            
            // Agregamos el evento para agregar comentarios
            $('#send').click(function (e) { 
                e.preventDefault();
                
                const $comment = $('#comment');
                if( $comment.val() ){
                    // Realizamos petición post para agregar comentario
                    axios.post('{{ route('api.comentarios.store') }}', {
                        post_id: 1,
                        user_id: userId,
                        comentario: $comment.val(),
                    })
                    .then(function (response) {
                        // Limpiamos el input
                        $comment.val('');
                    })
                }               
            });

            // Escuchamos al canal para rellenar los comentarios
            Echo.channel('comments')
                .listen('CommentCreated', (e) => {
                    console.log( e );
                    // Agregamos el comentario
                    addComment( e.usuario, e.comentario );
                });
        });

        // Creamos función para agregar comentarios
        function addComment( name, comment ) {
            // Obtenemos el nombre
            var name = name;
            // Obtenemos el comentario
            var comment = comment;

            // Validamos que no estén vacíos
            if (comment != '' && name != '') {
                // Creamos el elemento li
                var li = $('<li>');
                // Creamos el elemento div
                var div = $('<div class="text-sm flex flex-start items-center justify-between">');
                // Creamos el elemento p
                var p = $('<p class="font-bold ml-2">');
                    
                // Creamos el elemento a
                var a = $('<a class="cursor-pointer">');
                // Creamos el elemento span
                var span = $('<span class="text-gray-700 font-medium ml-1">');

                // Agregamos el nombre al elemento a
                a.append(name + ':');
                // Agregamos el comentario al elemento span
                span.append(comment);

                // Agregamos el elemento a al elemento p
                p.append(a);
                // Agregamos el elemento span al elemento p
                p.append(span);

                // Agregamos el elemento p al elemento div
                div.append(p);

                // Agregamos el elemento div al elemento li
                li.append(div);

                // Agregamos el elemento li al elemento ul
                $('#comments').append(li);
            }
        }
    </script>
@endpush