/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        extend: {
            colors: {
                primary: "#0e7a3f",
                "primary-dark": "#0a5c30",
                "primary-light": "#e6f4ea",

                accent: "#ea6a12",
                "accent-light": "#fdece0",

                ink: "#182420",
                "ink-soft": "#5c6862",

                cream: "#faf8f3",
                line: "#e7e2d4",
            },

            fontFamily: {
                display: ['"Plus Jakarta Sans"', "sans-serif"],
                body: ["Inter", "sans-serif"],
            },
        },
    },

    plugins: [],
};