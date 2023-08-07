@extends('layouts.app')

@section('titulo')
    {{ __('Ruleta rusa') }}
@endsection

@section('contenido')
    <div class="w-full flex justify-center items-center flex-col gap-5">
        <img src="{{ asset('assets/img/circle.png') }}" class="" id="circle" width="250" height="250" alt="Imagen de la Ruleta">

        <p id="winner" class="font-bold"></p>

        <hr>
        <div class="flex items-center justify-center flex-col gap-2">
            <label for="bet" class="font-bold">Tu tiro</label>
            <select name="bet" id="bet">
                <option selected>Fuera de</option>
                @foreach ( range(1, 12) as $number )
                    <option>{{ $number }}</option>
                @endforeach
            </select>
            <p class="font-bold mt-5">Tiempo restante: <span id="timer" class="text-red-400">Esperando...</span></p>
        </div>
        <hr>
        <p id="result" class="font-bold text-2xl mb-5"></p>
    </div>
@endsection

{{-- ========================================= --}}
{{-- Estilos y scripts adicionales --}}



@push('styles')
    {{-- Estilos adicionales --}}

    <style>
        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg)
            }
        }

        .rotate {
            animation: rotate 3s linear infinite;
        }
    </style>
@endpush

@push('scripts')
    {{-- Scripts adicionales --}}

    <script>
        $(document).ready(function () {
            // Obtenemos los elementos del DOOM
            const $circle = $('#circle');
            const $winner = $('#winner');
            const $bet    = $('#bet');
            const $timer  = $('#timer');
            const $result = $('#result');

            // Escuchamos los eventos con Laravel ECHO
            Echo.channel('ruleta')
                .listen('RemainingTimeChanged', ( e ) => {
                    // Mostramos el tiempo restante
                    $timer.text(e.time);

                    // Habilitamos el select
                    $bet.attr('disabled', false);

                    // Agregamos la clase rotate
                    $circle.addClass('rotate');
                })
                .listen('WinnerNumberGenerated', ( e ) => {
                    // Mostramos el ganador
                    $winner.text(`El número ganador es ${ e.winnerNumber }`);

                    // Removemos la clase rotate
                    $circle.removeClass('rotate');
                    // Validamos si la selección es ganadora
                    if ( e.winnerNumber == $bet.val() ) {
                        // Mostramos el resultado
                        $result.text('Ganaste');
                        $result.addClass('text-green-600');
                    } else {
                        // Mostramos el resultado
                        $result.text('Perdiste');
                        $result.addClass('text-red-600');
                    }

                    // Deshabilitamos el select
                    $bet.attr('disabled', true);
                    $bet.val('Fuera de');
                })
        });
    </script>
@endpush

