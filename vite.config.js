import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',

                'Modules/Blog/resources/assets/css/blog.css',
                'Modules/Blog/resources/assets/js/blog.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
