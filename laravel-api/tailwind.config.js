import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#ff2d20',
                primaryHover: '#e62b1d',
                sidebarBg: 'rgba(255,45,32,0.1)', // #ff2d201a
                sidebarText: '#333333',
                tableRowAlt: '#f9f9f9',
                inputBorder: '#dddddd',
            },
            boxShadow: {
                card: '0 1px 2px 0 rgba(0,0,0,0.05)',
            },
        },
    },
    plugins: [forms],
};
