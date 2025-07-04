import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: false,
    // encrypted: true,
    authEndpoint: '/broadcasting/auth',
    // auth: {
    //     headers: {
    //         Authorization: `Bearer ${localStorage.getItem('token')}` // If API token is used
    //     }
    // }
});
//
//
// window.Echo.connector.pusher.connection.bind('connected', () => {
//     console.log('Pusher connected!');
// });
//
// window.Echo.private('private-chat.1.2').subscription.bind('pusher:subscription_succeeded', () => {
//     console.log('Subscribed to private-chat.1.2 channel successfully!');
// });
//
// window.Echo.private('private-chat.2.2').subscription.bind('pusher:subscription_error', (err) => {
//     console.error('Failed to subscribe to private-chat.2.2 channel:', err);
// });
//
//
// window.Echo.private('private-chat.2.1')
//     .subscribed(() => {
//         console.log('Subscribed to private chat.2.1 channel successfully!');
//     })
//     .error((error) => {
//         console.error('Failed to subscribe to private chat.2.2 channel:', error);
//     })
//     .listen('message-sent', (data) => {
//         console.log('Test message received:', data);
//     });


const fromId = window.authUserId;
const toId = window.chatReceiverId;

console.log("From ID: ", fromId);
console.log("To ID: ", toId);

if (fromId && toId) {
    // First channel: current user sending to friend
    window.Echo.private(`private-chat.${fromId}.${toId}`)
        .subscribed(() => {
            console.log(`Subscribed to private-chat.${fromId}.${toId}`);
        })
        .listen('.message-sent', (data) => {
            console.log('Message received:', data);
        })
        .listen('.user-typing', (data) => {
            console.log(`User ${data.from_user_id} is typing...`);
            Livewire.dispatch('typing-received', { userId: data.from_user_id });
        });

    // Second channel: reverse direction
    window.Echo.private(`private-chat.${toId}.${fromId}`)
        .subscribed(() => {
            console.log(`Subscribed to private-chat.${toId}.${fromId}`);
        })
        .listen('.message-sent', (data) => {
            console.log('Message received (reverse):', data);
        })
        .listen('.user-typing', (data) => {
            console.log(`User ${data.from_user_id} is typing (reverse)...`);
            Livewire.dispatch('typing-received', { userId: data.from_user_id });
        });
} else {
    console.warn('authUserId or chatReceiverId is undefined – skipping private channel subscription.');
}
