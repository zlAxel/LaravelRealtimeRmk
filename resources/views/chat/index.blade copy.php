@extends('layouts.app')

@section('titulo')
    {{ __('Listado de usuarios') }}
@endsection

@section('contenido')
    <div class="container mx-auto">
        <div class="min-w-full border rounded lg:grid lg:grid-cols-3">
            <div class="hidden lg:col-span-2 lg:block">
                <div class="w-full">
                <div class="relative flex items-center p-3 border-b border-gray-300">
                    <span class="w-2 h-2 bg-green-600 rounded-full ml-2"></span>
                    <span class="block ml-2 font-bold text-gray-600">Chat en vivo</span>
                </div>
                {{-- ! Lista de mensajes --}}
                <div class="relative w-full p-6 overflow-y-auto h-[40rem]">
                    <ul class="space-y-2" id="messages">
                        {{-- * Mensajes rellenados con Laravel Echo --}}
                    </ul>
                </div>
                {{-- ! Input del mensaje y botón de envíar --}}
                <form>
                    <div class="flex items-center justify-between w-full p-3 border-t border-gray-300">
                        <input type="text" placeholder="Message"
                        class="block w-full py-2 pl-4 mx-3 bg-gray-100 rounded-full outline-none focus:text-gray-700"
                        name="message" id="message" required />
    
                        <button type="submit" id="send">
                            <svg class="w-5 h-5 text-gray-500 origin-center transform rotate-90" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path
                                d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                            </svg>
                        </button>
                    </div>
                </form>
                </div>
            </div>
            <div class="border-r border-l border-gray-300 lg:col-span-1">
                <h2 class="text-lg text-gray-700 border-b border-gray-300 flex justify-center items-center font-bold h-12">Usuarios activos</h2>
                <ul class="overflow-auto h-[32rem]" id="users">
                    {{-- * Usuarios rellenados con Laravel Echo --}}
                </ul>
            </div>
        </div>
    </div>
@endsection

{{-- ========================================= --}}
{{-- Estilos y scripts adicionales --}}



@push('styles')
    {{-- Estilos adicionales --}}
@endpush

@push('scripts')
    {{-- Scripts adicionales --}}
    <script>
        $(document).ready(function () {

            // Almacena el ID del usuario autenticado en una variable de JavaScript
            const userId = @json($userId);

            // Obtener usuarios activos
            const userList     = document.getElementById('users');
            const messagesList = document.getElementById('messages');
            const liClasses    = [ 'flex', 'items-center', 'px-3', 'py-2', 'text-sm', 'transition', 'duration-150', 'ease-in-out', 'cursor-pointer', 'hover:bg-gray-100', 'focus:outline-none' ];
            const spanClasses  = [ 'block', 'ml-2', 'font-semibold', 'text-gray-600', 'select-none' ];

            Echo.join('chat')
                .here( users => {
                    users.map( user => {
                        if( user.id !== userId)
                            addUser(user.id, user.name);
                    })
                })
                .joining( user => {
                    addUser(user.id, user.name);
                })
                .leaving( user => {
                    let li = document.getElementById( user.id );
                        li.parentNode.removeChild( li );
                })
                .listen('MessageSent', message => {
                    let li = document.createElement('li');
                    li.className = "flex justify-start";
                    
                    let div = document.createElement('div');
                    div.className = "relative max-w-xl px-4 py-2 text-gray-700 rounded shadow";

                    let spanName    = document.createElement('span');
                    let spanMessage = document.createElement('span');

                    spanName.classList = "block text-xs font-bold pb-1";
                    spanName.innerText = message.user.name;

                    spanMessage.classList = "block";
                    spanMessage.innerText = message.message;

                    div.append( spanName, spanMessage );
                    
                    li.appendChild( div );
                    
                    messagesList.appendChild( li );
                })

            // Agregar usuarios al <ul> (DOM)
            function addUser(id, name) {
                let li = document.createElement('li');
                    li.setAttribute( 'id', id );
                    liClasses.forEach( className => {
                        li.classList.add( className );
                    });

                let span = document.createElement('span');
                    span.innerText = name;
                    spanClasses.forEach( className => {
                        span.classList.add( className );
                    });

                li.appendChild( span );

                userList.appendChild( li );
            }


            // Evento para envíar mensajes
            $('#send').on('click', function (e) {
                e.preventDefault();

                window.axios.post('/chat/message', {
                    message: $('#message').val(),
                })

                $('#message').val('');
            });

            // Evento para envíar saludos
            $('#users').on('click', 'li', function () {
                window.axios.post(`/chat/greet/${ this.id }`);
            });

            Echo.private('chat.greet.{{ auth()->user()->id }}')
                .listen('GreetingSent', greet => {
                    let li = document.createElement('li');
                    li.className = "flex justify-start";
                    
                    let div = document.createElement('div');
                    div.className = "relative max-w-xl px-4 py-2 text-gray-700 rounded shadow";

                    let spanMessage    = document.createElement('span');

                    spanMessage.classList = "block text-xs font-bold pb-1 text-teal-500";
                    spanMessage.innerText = greet.greeting;

                    div.appendChild( spanMessage );
                    
                    li.appendChild( div );
                    
                    messagesList.appendChild( li );
                })

        });
    </script>
@endpush

