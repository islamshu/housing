import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Initialize Pusher first
window.Pusher = Pusher;

// Initialize Echo with proper error handling
try {
    window.Echo = new Echo({
        broadcaster: 'reverb',
        key: import.meta.env.VITE_REVERB_APP_KEY,
        wsHost: window.location.hostname,
        wsPort: import.meta.env.VITE_REVERB_PORT || 8080,
        forceTLS: false,
        enabledTransports: ['ws', 'wss']
    });

    // Safe event listener
    if (window.Echo?.connector?.socket) {
        window.Echo.connector.socket.on('connect', () => {
            console.log('✅ Connected to Reverb');
        });
    }
} catch (error) {
    console.error('Echo initialization failed:', error);
}
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';
