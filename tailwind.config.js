/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./site/**/*.php", "./assets/js/**/*.js", "./index.php"],
  safelist: [
    "rounded-2xl",
    "border-gray-500",
    "text-secondary",
    "text-sm",
    "font-medium",
  ],
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
      container: {
        center: true,
        padding: {
          DEFAULT: "1rem",
          sm: "2rem",
          lg: "4rem",
          xl: "5rem",
        },
      },
      screens: {
        sm: "640px",
        md: "768px",
        lg: "1024px",
        xl: "1280px",
        "2xl": "1536px",
      },
    },
  },
  plugins: [require("@tailwindcss/typography")],
};
