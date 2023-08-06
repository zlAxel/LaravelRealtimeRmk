@extends('layouts.app')

@section('titulo')
    {{ __('Listado de usuarios') }}
@endsection

@section('contenido')
    <ul id="users">
        {{-- * Elementos llenados con Axios (API) --}}
    </ul>
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
            // Elemento HTML donde se mostrarán los usuarios
            const $users = document.getElementById('users');

            // Petición Axios
            window.axios.get('{{ route('api.users.index') }}')
                .then(function (response) {
                    let users = response.data;

                    users.map( user => {
                        let li = document.createElement('li');

                        li.setAttribute( 'id', user.id )
                        li.innerText = user.name;

                        $users.appendChild( li );
                    })
                })
                .catch(function (error) {
                    console.log(error);
                });
        });
    </script>
    <script>
        $(document).ready(function () {
            // Elemento HTML donde se mostrarán los usuarios
            const $users = document.getElementById('users');

            // Escuchamos al canal de usuarios
            Echo.channel('users')
                .listen('UserCreated', (e) => {
                    let li = document.createElement('li');

                    li.setAttribute( 'id', e.user.id )
                    li.innerText = e.user.name;

                    $users.appendChild( li );
                })
                .listen('UserUpdated', (e) => {
                    let li = document.getElementById( e.user.id );

                    li.innerText = e.user.name;
                })
                .listen('UserDeleted', (e) => {
                    let li = document.getElementById( e.user.id );

                    li.parentNode.removeChild( li );
                });
        });
    </script>
@endpush

