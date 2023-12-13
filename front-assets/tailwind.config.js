/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./public/**/*.html",
    "./public/**/*.css",
    "./public/**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        dark: '#333',
        light: '#fff',
        lightest: '#BDBDBF',
        hover: '#f96d6d',
        blue: '#0066FF',
        blu: '#2B2D42',
        red: '#FD3D57',
        black: '#2B2D42',
        gold: '#FFD755',
        green: '#48A61F',
        orange: '#FFA500',
      },
    },
  },
  plugins: [],
}