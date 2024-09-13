const defaultTheme = require("tailwindcss/defaultTheme");
import fluid, { extract, fontSize, screens } from "fluid-tailwind";

/** @type {import('tailwindcss').Config} */
export default {
    content: {
        files: [
            "./resources/**/*.blade.php",
            "./resources/**/*.js",
            "./resources/**/*.vue",
            "./vendor/awcodes/filament-tiptap-editor/resources/**/*.blade.php",
        ],
        extract,
    },
    theme: {
        screens: {
            ...screens,
            "footer-small": "25rem",
        },
        fontSize,
        extend: {
            // dropShadow: {
            //     nav: "1px 1px 21px 1px rgba(0,0,0,0.75);",
            // },

            backgroundImage: {
                "gradient-radial": "radial-gradient(var(--tw-gradient-stops))",
                brick: "url('/resources/assets/brick-pattern.webp')",
            },
            boxShadow: {
                nav: "0px 0px 18px 1px rgba(0,0,0,0.50);",
                top: "0px 0px 15px 1px rgba(0,0,0,0.35);",
                "top-hover": "0px 0px 20px 1px rgba(0,0,0,0.25);",
            },
            dropShadow: {
                top: [
                    "0 0 15px rgb(0 0 0 / 0.04)",
                    "0 0 10px rgb(0 0 0 / 0.1)",
                ],
            },
            fontSize: {
                xxs: "0.5rem",
            },
            fontFamily: {
                androgyne: "Androgyne",
                montserrat: "Montserrat",
                ...defaultTheme.fontFamily.sans,
                poppins: "Poppins",
                ...defaultTheme.fontFamily.sans,
                "great-vibes": [
                    "Great Vibes",
                    ...defaultTheme.fontFamily.serif,
                ],
                lobster: ["Lobster", ...defaultTheme.fontFamily.serif],
                "open-sans": ["Open Sans", ...defaultTheme.fontFamily.sans],
            },
            zIndex: {
                1: 1,
            },

            // colors
            colors: {
                cedea: {
                    //'red': '#b22a2e',
                    red: {
                        DEFAULT: "#BA0020",
                        50: "#FF738B",
                        100: "#FF5E7A",
                        200: "#FF3558",
                        300: "#FF0D36",
                        400: "#E30027",
                        500: "#BA0020",
                        600: "#820016",
                        700: "#4A000D",
                        800: "#120003",
                        900: "#000000",
                        950: "#000000",
                    },
                    "red-dark": "#B90020",
                    "yellow-1": "#F3B91A",
                    "yellow-2": "#F8DA04",
                },
            },

            // container
            container: {
                center: true,
                padding: "1rem",
                screens: {
                    // sm: "540px",
                    // md: "720px",
                    // lg: "960px",
                    xl: "1140px",
                    "2xl": "1320px",
                },
            },

            animation: {
                float: "float 1s ease-in-out infinite",
                slideBottom:
                    "slideBottom 0.7s cubic-bezier(0.250, 0.460, 0.450, 0.940) both",
            },

            // keyframes
            keyframes: {
                float: {
                    "0%, 100%": { transform: "translatey(0px)" },
                    "50%": { transform: "translatey(-20px)" },
                },
                slideBottom: {
                    "0%": { transform: "translateX(500px); opacity: 0;" },
                    "90%": { opacity: 0.7 },
                    "100%": { transform: "translateX(0);", opacity: 1 },
                },
            },
            typography: (theme) => ({
                DEFAULT: {
                    css: {
                        maxWidth: "none",
                    },
                },
            }),
        },
    },
    plugins: [require("@tailwindcss/typography"), fluid],
};
