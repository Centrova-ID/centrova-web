/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  safelist: [
    // Common dynamic classes that might get purged
    'bg-blue-500', 'bg-red-500', 'bg-green-500', 'bg-yellow-500',
    'text-blue-500', 'text-red-500', 'text-green-500', 'text-yellow-500',
    'border-blue-500', 'border-red-500', 'border-green-500', 'border-yellow-500',
    'hidden', 'block', 'flex', 'inline-block', 'inline-flex',
    'opacity-0', 'opacity-50', 'opacity-100',
    'translate-x-0', 'translate-x-full', '-translate-x-full',
    'translate-y-0', 'translate-y-full', '-translate-y-full',
    'scale-0', 'scale-50', 'scale-75', 'scale-90', 'scale-95', 'scale-100', 'scale-105', 'scale-110',
    // Animation classes
    'transition-all', 'transition-opacity', 'transition-transform',
    'duration-150', 'duration-200', 'duration-300', 'duration-500',
    'ease-in', 'ease-out', 'ease-in-out',
    // AOS animation classes
    'aos-init', 'aos-animate',
    // Alpine.js common classes
    {
      pattern: /^(x-|:|@)/,
    }
  ],
  theme: {
    extend: {
      fontFamily: {
        'sans': ['Inter', 'Helvetica Neue', 'Helvetica', 'Noto Sans', 'Arial', 'sans-serif'],
        'helvetica': ['Helvetica Neue', 'Helvetica', 'Inter', 'Arial', 'sans-serif']
      }
    },
  },
  plugins: [],
}
