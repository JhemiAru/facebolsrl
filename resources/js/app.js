/* import './bootstrap';

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true
});

// Escuchar eventos
window.Echo.channel('real-time-channel')
    .listen('RealTimeEvent', (data) => {
        window.livewire.emit('messageReceived', data.message);
    });
 */

import './bootstrap';
import Echo from 'laravel-echo';

// Manejar errores AJAX globalmente (incluyendo CSRF 419)
$(document).ajaxError(function (event, jqxhr, settings, thrownError) {
    if (jqxhr.status === 419) { // Token CSRF expirado
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
        });

        Toast.fire({
            icon: 'error',
            title: 'Tu sesión expiró. Recargando...'
        });

        setTimeout(() => location.reload(), 3000); // Recarga después de 3 segundos
    }
});

// Configuración de Laravel Echo (tu código actual)
// Aquí colocas tu código Echo
window.Echo.channel('canal-datos')
    .listen('.evento.actualizacion', (data) => {
        console.log('Datos actualizados:', data.datos);
        // Actualiza la UI sin recargar
        document.getElementById('datos-container').innerHTML = data.datos.campo_relevante;
    });

// Escuchar eventos
/* window.Echo.channel('real-time-channel')
    .listen('RealTimeEvent', (data) => {
        window.livewire.emit('messageReceived', data.message);
    }); */