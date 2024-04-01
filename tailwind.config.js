/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {

            //animation
            animation: {
                float: 'float 1s ease-in-out infinite'
            },

            // colors
            colors: {
                'cedea': {
                    //'red': '#b22a2e',
                    'red': '#d02028',
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

            // keyframes

            keyframes: {
                float: {
                  '0%, 100%': { transform: 'translatey(0px)' },
                  '50%': { transform: 'translatey(-20px)' },
                }
            },
        },
    },
    plugins: [],
}

