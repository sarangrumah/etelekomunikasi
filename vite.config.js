import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel([
            'assets/css/all.min.css',
            'assets/js/app.js',
        ]),
    ],
});
