import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                brand: {
                    black: '#0A0A0A',
                    'dark': '#1A1A1A',
                    gray: '#111111',
                    yellow: '#E5C100',
                    gold: '#D4A017',
                },
            },
            fontFamily: {
                heading: ['Oswald', ...defaultTheme.fontFamily.sans],
                body: ['Inter', ...defaultTheme.fontFamily.sans],
                script: ['Dancing Script', 'cursive'],
            },
        },
    },

    plugins: [forms],
};
