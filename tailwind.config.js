/** @type {import('tailwindcss').Config} */
// module.exports = {
//   content: [],
//   theme: {
//     extend: {},
//   },
//   plugins: [],
// }

module.exports = {
    content: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
    theme  : {
        extend: {
            colors    : {
                "pri-color": "var(--pri-color)",
                "sec-color": "var(--sec-color)",
                "d8"       : "var(--d8-color)",
                "back"     : "var(--back-color)",
            },
            fontFamily: {
                'shabnam-fd': ['shabnam-fd', 'sans-serif']
            },
            width     : {
                "p"  : "var(--platform-width)",
                "p-1": "var(--platform-width-1)",
            },
            maxWidth  : {
                "p"  : "var(--platform-width)",
                "p-1": "var(--platform-width-1)",
            },
            boxShadow : {
                "3d": "0px 0px 8px 0 #000",
            }
        },
    },
    plugins: [],
}

