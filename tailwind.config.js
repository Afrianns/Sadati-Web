/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                Inter: ["Inter", "sans-serif"],
                Mohave: ["Mohave", "sans-serif"],
                LeagueSpartan: ["League Spartan", "sans-serif"],
            },
            screens: {
                lgm: "850px",
                mdl: "650px",
                mdm: "580px",
                mds: "350px",
            },
            colors: {
                // secondary: "#ffddaa",
                // secondary: "#590525",
                secondary: "#e44e3e",
            },
        },
    },
    plugins: [],
};
