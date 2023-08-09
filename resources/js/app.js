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