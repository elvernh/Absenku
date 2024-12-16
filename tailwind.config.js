import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins','Figtree', ...defaultTheme.fontFamily.sans],
            },

            fontSize:{
                'huge': '50px'
            },
            colors:{
                'custom-blue': '#211F60'
            },
            spacing: {
                '128': '32rem',  // Custom size for width or height
                '144': '36rem',  // Another custom size
              },
        },
    },
    plugins: [],
};
