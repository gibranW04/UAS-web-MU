/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                manu: {
                    red: '#DA291C',
                    'red-dark': '#B91C1C',
                    'red-darker': '#991B1B',
                    black: '#0a0a0a',
                }
            }
        },
    },
    plugins: [],
}
