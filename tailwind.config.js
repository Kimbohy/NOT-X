/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js,php}", "*.php"],
  theme: {
    extend: {
      colors: {
        casse: "#FAF7F0",
        beige: "#D8D2C2",
        maron: "#B17457",
        gris: "#4A4947",
        post: "#D9D9D9",
        noire: "#000000",
        blanche: "#F4F4F4",
      },
    },
  },
  plugins: [],
};

// npx tailwindcss -i ./src/input.css -o ./src/output.css --watch
