const cache = 'hinario:v1'
const assets = ['/']

self.addEventListener('install', installEvent => {
    installEvent.waitUntil(
        caches.open(cache).then(cache => {
            return cache.addAll(assets).then(() => self.skipWaiting())
        })
    )
})

self.addEventListener('fetch', fetchEvent => {
    fetchEvent.respondWith(
        caches.match(fetchEvent.request).then(response => {
            return response || fetch(fetchEvent.request)
        })
    )
})
