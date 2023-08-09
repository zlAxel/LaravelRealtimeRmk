// ! ---------------------------------------------------------------
// ! Función para remover notificación

function removeNotification() {
    $('#notification').removeClass('!translate-x-0');

    setTimeout(() => {
        // * Asignamos los valores
        $('#notification #name').html('');
        $('#notification #message').html('');
        $('#notification #state').html('');
    }, 3000);
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