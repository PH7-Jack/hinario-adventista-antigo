const { InjectManifest } = require('workbox-webpack-plugin')
const mix = require('laravel-mix')

mix.js('resources/js/app.js', 'public/dist')
    .js('resources/js/pwa.js', 'public/dist')
    .postCss('resources/css/app.css', 'public/dist', [
        require('postcss-import'),
        require('tailwindcss'),
    ])

if (mix.inProduction()) {
    mix.webpackConfig({
        plugins: [
            new InjectManifest({
                swSrc: './resources/js/service-worker/index.js',
                swDest: './service-worker.js',
                modifyURLPrefix: {
                    '//': '/', // fix for file url. Ref https://github.com/GoogleChrome/workbox/issues/1534
                },
            })
        ],
    }).version()
}

mix.disableSuccessNotifications()
