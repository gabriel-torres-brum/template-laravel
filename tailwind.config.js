/** @type {import('tailwindcss').Config} */
const colors = require('tailwindcss/colors');

module.exports = {
    darkMode: ["class", "data-theme='dark'"],
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: { 
        extend: {},
    },
    plugins: [require("daisyui")],
    daisyui: {
        themes: [
            {
                light: {
                    primary: colors.cyan[300],
                    secondary: colors.amber[400],
                    accent: colors.teal[300],
                    neutral: "#3d4451",
                    "base-content": colors.slate[600],
                    "primary-content": colors.cyan[50],
                    "base-100": "#FFFFFF",
                    "base-200": "#FAFAFA",
                    "base-300": "#EFEFEF",
                },
                dark: {
                    primary: colors.cyan[500],
                    secondary: colors.amber[500],
                    accent: colors.teal[500],
                    neutral: "#3d4451",
                    "base-content": colors.slate[200],
                    "primary-content": colors.cyan[100],
                    "base-100": colors.slate[800],
                    "base-200": colors.slate[700],
                    "base-300": colors.slate[600],
                },
            },
        ],
    },
};
