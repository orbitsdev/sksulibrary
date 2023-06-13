const colors = require('tailwindcss/colors')

module.exports = {
    presets: [
       
        require('./vendor/wireui/wireui/tailwind.config.js')
    ],
    content: [
        './resources/**/*.blade.php',
         './vendor/filament/**/*.blade.php',
         './vendor/wireui/wireui/resources/**/*.blade.php',
         './vendor/wireui/wireui/ts/**/*.ts',
         './vendor/wireui/wireui/src/View/**/*.php'
 
        ],
    theme: {
        extend: {
            colors: {
                danger: colors.rose,
                primary: colors.green,
                success: colors.green,
                warning: colors.yellow,
                info: colors.blue,

                // warning: colors.yellow,
                main: '#0A4F01',
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}
