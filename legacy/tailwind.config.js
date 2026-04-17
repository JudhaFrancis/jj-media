/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,php}"],
  theme: {
    extend: {
      colors: {
        theme: "#6ebe45",
        theme2: "#F20F10",
        title: "#0F2239",
        body: "#4D5765",
        smoke: "#F3F7FB",
        light: "#72849B",
        yellow: "#FFB539",
        success: "#28a745",
        error: "#dc3545",
        border: "#ecf1f9",
      },
      fontFamily: {
        title: ["Jost", "sans-serif"],
        body: ["Roboto", "sans-serif"],
      },
      container: {
        center: true,
        padding: "1rem",
        screens: {
          sm: "600px",
          md: "728px",
          lg: "984px",
          xl: "1240px",
          "2xl": "1380px",
        },
      },
      animation: {
        marquee: 'marquee 40s linear infinite',
      },
      keyframes: {
        marquee: {
          '0%': { transform: 'translateX(0%)' },
          '100%': { transform: 'translateX(-100%)' },
        }
      }
    },
  },
  plugins: [],
};
