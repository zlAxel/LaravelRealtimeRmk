<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// ! Habilitamos notificaciones solo para usuarios autenticados
Broadcast::channel('notifications', function ($user) {
    return $user->id != null;
});

// ! Definimos el canal para el chat
Broadcast::channel('chat', function ($user) {
    if( $user != null ){
        return [
            'id'   => $user->id,
            'name' => $user->name,
        ];
    }
});

// ! Definimos el canal para el saludo
Broadcast::channel('greeting-user.{user_id}', function ($user, $user_id) {
    return $user->id == $user_id;
});

// ! Definimos el canal para la notificación
Broadcast::channel('notifications.{user_id}', function ($user, $user_id) {
    return $user->id == $user_id;
});
