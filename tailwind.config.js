import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'dark-green': '#064e3b',
                'deep-black': '#000000',
                'ai-primary': '#10b981', // emerald-500
                'ai-secondary': '#059669', // emerald-600
            },
            backgroundImage: {
                'gradient-ai': 'linear-gradient(to bottom right, #000000, #064e3b)',
            }
        },
    },

    plugins: [forms],
};
