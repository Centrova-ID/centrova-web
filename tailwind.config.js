/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        'sans': ['Plus Jakarta Sans', 'sans-serif'],
        'plusjakarta': ['Plus Jakarta Sans', 'sans-serif'],
        'figtree': ['Figtree', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
