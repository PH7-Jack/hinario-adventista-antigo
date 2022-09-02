import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import mkcert from'vite-plugin-mkcert'

export default defineConfig({
    plugins: [
        mkcert(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/pwa.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        https: true,
   },
})
