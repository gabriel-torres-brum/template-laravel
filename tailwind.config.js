/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: "class",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        // './vendor/usernotnull/tall-toasts/config/**/*.php',
        // './vendor/usernotnull/tall-toasts/resources/views/**/*.blade.php',
    ],
    safelist: [
        {
            pattern: /(bg|text)-(red|green|blue|amber)-(500|600)/,
            variants: ['hover']
        },
        {
            pattern: /(ring)-(red|green|blue|amber)-400/,
            variants: ['focus']
        },
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require('@tailwindcss/forms')
    ]
};
