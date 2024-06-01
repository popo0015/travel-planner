/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                'ticket-left': '#DAC7A0',
                'ticket-right': '#F3E4B3',
                'ticket-bg': '#EDE3CF',
            }
        },
    },
    plugins: [],
};
