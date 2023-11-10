/** @type {import('tailwindcss').Config} */
const plugin = require('tailwindcss/plugin');
const { addDynamicIconSelectors } = require('@iconify/tailwind');
module.exports = {
  content: [
    "./views/layout.php",
    "./views/**/*.html,js,jsx,ts,tsx,php",
    "./public/index.html",
    "./public/index.php",
    "./public/**/*.{html,js,jsx,ts,tsx}" /** Aqui indicamos que todos los archivos dentro de la carpeta 
    public con las extensiones descritas formaran parte de tailwind css
    (./carpeta/**(todos los archivos y subcarpetas)/*.(todos los archivos con las extensiones))*/],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
    require('@tailwindcss/aspect-ratio'),
    require('@tailwindcss/container-queries'),
    plugin(function ({ addUtilities, addComponents, e, config }) {
      // Add your custom styles here
      // Iconify plugin
      addDynamicIconSelectors()
    }),
  ],
}

