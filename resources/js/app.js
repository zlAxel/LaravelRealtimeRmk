import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// ! ---------------------------------------------------------------
// ! Configuración para remover notificación con jQuery

$(document).ready(function () {
    $('#close_notification').click(function (e) { 
        removeNotification();
    });

    // TODO | Escuchamos el evento de notificación con Echo
    Echo.private('notifications')
        .listen('UserSessionChanged', (e) => {
            // ? Asignamos el estado de la notificación
            let state = null
            switch (e.type) {
                case 'success':
                    state = 'Activo';
                    break;
                case 'danger':
                    state = 'Inactivo';
                    break;
            }

            // ? Agregamos la notificación con los datos del evento
            addNotification(e.name, 'Ha cambiado su estado a:', state, e.type);
        }); 
    // ? Fin del evento de notificación con Echo       
});

// ! ---------------------------------------------------------------
// ! Función para remover notificación

function removeNotification() {
    $('#notification').removeClass('!translate-x-0');

    // * Asignamos los valores
    $('#notification #name').html('');
    $('#notification #message').html('');
    $('#notification #state').html('');
}

// ! ---------------------------------------------------------------
// ! Función para agregar datos de la notificación

function addNotification(title, message, state, type) {
    // * Removemos las clases de los colores
    $('#notification #dot_state').removeClass('bg-green-400 bg-red-400');
    $('#notification #state').removeClass('text-green-600 text-red-600');

    // * Asignamos los valores
    $('#notification #name').html(title);
    $('#notification #message').html(message);
    $('#notification #state').html(state);

    // * Asignamos las clases de los colores
    switch (type) {
        case 'success':
            $('#notification #dot_state').addClass('bg-green-400');
            $('#notification #state').addClass('text-green-600');
            break;
        case 'danger':
            $('#notification #dot_state').addClass('bg-red-400');
            $('#notification #state').addClass('text-red-600');
            break;
    }

    // * Agregamos la clase para mostrar la notificación
    $('#notification').addClass('!translate-x-0');
}