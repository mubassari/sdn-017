/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: "class",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "node_modules/flowbite/**/*.{js,jsx,ts,tsx}",
    ],
    plugins: [require("flowbite/plugin"), require("flowbite-typography")],
    theme: {
        extend: {
            zIndex: {
                100: "100",
            },
        },
    },
};
