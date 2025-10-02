import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'Modules/Blog/resources/assets/css/app.css',
                'Modules/Blog/resources/assets/js/app.js',
                'Modules/BlogAdmin/Resources/js/app.js',
                'Modules/BlogAdmin/Resources/css/app.css',
            ],
            refresh: true,
        }),

        tailwindcss(),
        vue(),
    ]
});
