/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./site/**/*.php", "./assets/js/**/*.js", "./index.php"],
  theme: {
    extend: {
      colors: {
        primary: "#891819",
        secondary: "#333333",
        light: "#f8f8f8",
        dark: "#222222",
      },
      fontFamily: {
        sans: ["Futura Std", "Arial", "sans-serif"],
      },
    },
  },
  plugins: [],
};
