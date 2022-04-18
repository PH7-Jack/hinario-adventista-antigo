import { Workbox } from 'workbox-window'

if ('serviceWorker' in navigator) {
    new Workbox('/service-worker.js').register()
}
