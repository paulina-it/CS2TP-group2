import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/assets/sass/app.scss',
                'resources/assets/js/app.js',
                'resources/assets/js/bookPage.js',
                'resources/assets/js/navbar.js',
            ],
            refresh: true,
        }),
    ],
});
