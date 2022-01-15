const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    mode: 'jit',
    presets: [
        require('./vendor/wireui/wireui/tailwind.config.js')
    ],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/wireui/wireui/resources/**/*.blade.php',
        './vendor/wireui/wireui/ts/**/*.ts',
        './vendor/wireui/wireui/src/View/**/*.php'
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                indigo: '0 4px 6px -1px rgba(129,140,248, 0.4), 0 2px 4px -1px rgba(129,140,248, 0.4)',
            }
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}
