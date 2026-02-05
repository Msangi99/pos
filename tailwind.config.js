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
            colors: {
                'deep-navy': '#0A0E1A',
                'royal-blue': '#1A237E',
                'bright-blue': '#2979FF',
                'cyan': '#00E5FF',
                'vibrant-green': '#76FF03',
            },
            borderRadius: {
                'xl': '12px',
                '2xl': '16px',
            },
            fontFamily: {
                sans: ['Inter', 'Roboto', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [],
};
