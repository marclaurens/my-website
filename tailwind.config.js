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
            fontFamily: {
                sans: ['Figtree', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            },
            colors: {
                gray: {
                    700: 'var(--text-color)',
                    900: 'var(--text-color)',
                },
                blue: {
                    500: 'var(--primary-color)',
                    600: 'var(--primary-color)',
                    700: 'var(--primary-color)',
                },
                indigo: {
                    500: 'var(--primary-color)',
                    600: 'var(--primary-color)',
                    700: 'var(--primary-color)',
                },
                amber: {
                    500: 'var(--accent-color)',
                    600: 'var(--accent-color)',
                },
            },
        },
    },

    plugins: [forms],
};