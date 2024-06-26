/** @type {import('tailwindcss').Config} */
const colors = require("tailwindcss/colors");
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./vendor/filament/**/*.blade.php",
    "./node_modules/flowbite/**/*.js"

  ],
  darkMode: "class",
  theme: {
    extend: {
      colors: {
        danger: colors.rose,
        primary: colors.purple,
        success: colors.green,
        warning: colors.yellow,
    },
    },
  },
  plugins: [
    require('flowbite/plugin'),
    require("@tailwindcss/forms"),
    require("@tailwindcss/typography"),

  ],
}

