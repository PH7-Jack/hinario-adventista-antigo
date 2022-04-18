require('./bootstrap')

import Alpine from 'alpinejs'
import persist from '@alpinejs/persist'

window.Alpine = Alpine

Alpine.plugin(persist)
Alpine.start()

window.addEventListener('offline', () => {
    if (navigator.onLine === false) {
        window.location.href = '/offline'
    }
})
