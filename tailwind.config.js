/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      height: {
        '10': '2.5rem',
      },
      width: {
        '10': '2.5rem',
      },
      colors: {
        'light-gray': '#f9fafb',
        'middle-gray': '#f3f4f6',
      },
      fontFamily: {
        lexend: ['Lexend', 'sans-serif'],
        dmsans: ['DM Sans', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
