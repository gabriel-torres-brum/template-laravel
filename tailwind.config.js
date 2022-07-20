/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: ['class', "data-theme='dark'"],
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('daisyui')
  ],
  daisyui: {
    themes: [
      'light',
      'dark'
    ]
  }
}