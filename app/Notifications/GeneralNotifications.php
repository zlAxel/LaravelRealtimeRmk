<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class GeneralNotifications extends Notification {
    use Queueable;

    // ! Creamos las propiedades de la notificación
    private int $user_id;
    public string $message;

    /**
     * Create a new notification instance.
     */
    public function __construct( int $user_id, string $message ) {
        $this->user_id = $user_id;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array {
        return ['database'];
    }

    // ! Creamos el array de la notificación para la base de datos
    /** 
     * Get the array representation of the notification.
     * 
     * @return array<string, string>
     */
    public function toDatabase(object $notifiable): array {
        return [
            'message' => $this->message,
        ];
    }
}
