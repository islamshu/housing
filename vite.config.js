import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
        }),
    ],
    define: {
        'process.env': {
            VITE_REVERB_APP_KEY: JSON.stringify(process.env.VITE_REVERB_APP_KEY),
            VITE_REVERB_PORT: JSON.stringify(process.env.VITE_REVERB_PORT),
        }
    }
});