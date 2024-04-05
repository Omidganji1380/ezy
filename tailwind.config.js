/** @type {import('tailwindcss').Config} */
// module.exports = {
//   content: [],
//   theme: {
//     extend: {},
//   },
//   plugins: [],
// }
module.exports = {
    content   : ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
    theme   : {
        extend: {
            colors    : {
                "pri-color": "var(--pri-color)",
                "sec-color": "var(--sec-color)"
            },
            fontFamily: {
                'shabnam-fd': ['shabnam-fd', 'sans-serif']
            },
            width     : {
                "p"  : "var(--platform-width)",
                "p-1": "var(--platform-width-1)",
            },
            maxWidth     : {
                "p"  : "var(--platform-width)",
                "p-1": "var(--platform-width-1)",
            },
        },
    },
    plugins : [],
}

