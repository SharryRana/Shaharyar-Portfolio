import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'Modules/Blog/resources/assets/css/app.css',
                'Modules/Blog/resources/assets/js/app.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
