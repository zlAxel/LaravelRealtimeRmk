<?php

namespace App\Events;

use App\Models\User;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // ! Definimos las propiedades que se enviarán al canal
    public $user;
    public $message;

    /**
     * Create a new event instance.
     */
    public function __construct( User $user, $message ) {
        $this->user    = $user;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array {
        \Log::debug("{$this->user->name}: {$this->message}");
        return [
            new PresenceChannel('chat'),
        ];
    }
}
