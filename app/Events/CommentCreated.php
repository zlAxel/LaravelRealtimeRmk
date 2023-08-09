<?php

namespace App\Events;

use App\Models\Comentario;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentCreated implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    // ! Agregamos el atributo comment
    private $comment;
    public $usuario;
    public $comentario;

    /**
     * Create a new event instance.
     */
    public function __construct( Comentario $comment ) {
        $this->comment = $comment;

        $this->usuario    = $comment->user->name;
        $this->comentario = $comment->comentario;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array {
        return [
            new Channel('comments'),
        ];
    }
}
