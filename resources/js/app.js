import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// ! Configuración para remover notificación con jQuery

$(document).ready(function () {
    $('#close_notification').click(function (e) { 
        removeNotification();
    });

    // addNotification('Gerardo Axel Macias Hoyos', 'Ha cambiado su estado a:', 'Activo', 'success')
    // addNotification('Gerardo Axel Macias Hoyos', 'Ha cambiado su estado a:', 'Inactivo', 'error')
});

// ! Función para remover notificación
function removeNotification() {
    $('#notification').removeClass('!translate-x-0');
}

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
        case 'error':
            $('#notification #dot_state').addClass('bg-red-400');
            $('#notification #state').addClass('text-red-600');
            break;
    }

    // * Agregamos la clase para mostrar la notificación
    $('#notification').addClass('!translate-x-0');
}