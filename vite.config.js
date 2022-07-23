import fs from 'fs'
import { homedir } from 'os'
import { resolve } from 'path'
import { defineConfig } from 'vite'
import laravel, { refreshPaths } from 'laravel-vite-plugin'

const host = 'hinario.test'

function detectServerConfig(host) {
    let keyPath = resolve(homedir(), `.valet/Certificates/${host}.key`)
    let certificatePath = resolve(homedir(), `.valet/Certificates/${host}.crt`)

    if (!fs.existsSync(keyPath)) {
        return {}
    }

    if (!fs.existsSync(certificatePath)) {
        return {}
    }

    return {
        hmr: {host},
        host,
        https: {
            key: fs.readFileSync(keyPath),
            cert: fs.readFileSync(certificatePath),
        },
    }
}

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
            refresh: [
                ...refreshPaths,
                'app/Http/Livewire/**'
            ]
        }),
    ],
    server: {
        https: true,
        // host: 'localhost',
   },
    // server: detectServerConfig(host)
})
