<?php

namespace App\Console\Commands;

use App\Events\RemainingTimeChanged;
use App\Events\WinnerNumberGenerated;

use Illuminate\Console\Command;

class GameExecutor extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:execute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ejecuta el juego de la ruleta';

    // ? Agregamos propiedad privada del tiempo de juego
    private int $time = 5;

    /**
     * Execute the console command.
     */
    public function handle() {
        // ? Arrancamos el juego de forma infinita
        while( true ){
            // ? Enviamos evento de tiempo restante
            broadcast( new RemainingTimeChanged( $this->time ) );
            // ? Esperamos un segundo
            sleep( 1 );
            // ? Restamos un segundo al tiempo
            $this->time--;
            // ? Si el tiempo es menor o igual a cero
            if( $this->time <= 0 ){
                // ? Generamos número aleatorio
                $winnerNumber = mt_rand( 1, 12 );
                // ? Enviamos mensaje de juego terminado
                broadcast( new RemainingTimeChanged( 'Juego terminado, espere a que inicie el siguiente juego' ) );

                // ? Enviamos evento de número ganador
                broadcast( new WinnerNumberGenerated( $winnerNumber ) );

                // ? Esperamos 5 segundos para reiniciar el juego
                sleep( 5 );
                $this->time = 5;
            }
        }
    }
}
