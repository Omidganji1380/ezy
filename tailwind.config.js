/** @type {import('tailwindcss').Config} */
// module.exports = {
//   content: [],
//   theme: {
//     extend: {},
//   },
//   plugins: [],
// }
module.exports = {
  purge: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors:{
        "pri-color": "var(--pri-color)",
        "sec-color": "var(--sec-color)"
      },
      fontFamily: {
        'shabnam-fd': ['shabnam-fd', 'sans-serif']
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}

