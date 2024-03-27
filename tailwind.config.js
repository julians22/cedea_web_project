/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {

            // colors
            colors: {
                'cedea': {
                    'red': '#b22a2e',
                    'reddark': '#991a1d',
                    'yellow-1': '#F3B91A',
                    'yellow-2': '#F8DA04'
                }
            },
            // container
            container: {
                center: true,
                screens: {
                    sm: '540px',
                    md: '720px',
                    lg: '960px',
                    xl: '1024px',
                    '2xl': '1200px',
                },
            },
        },
    },
    plugins: [],
}

