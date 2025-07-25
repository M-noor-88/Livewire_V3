import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: false,
    wsHost: import.meta.env.VITE_PUSHER_HOST,
    wsPort: import.meta.env.VITE_PUSHER_PORT,
    wssPort: import.meta.env.VITE_PUSHER_PORT,
    enabledTransports: ["ws", "wss"],
});



Livewire.hook('message.sent', (message, component) => {
    const socketId = window.Echo.socketId();
    if (socketId) {
        message.updateQueue = [
            {
                ...message.updateQueue[0],
                payload: {
                    ...message.updateQueue[0].payload,
                    _socket: socketId,
                },
            },
        ];
    }
});




