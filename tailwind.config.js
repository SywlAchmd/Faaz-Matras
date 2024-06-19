/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                "sunset-orange": "#F88C05",
                "crimson-red": "#D80001",
                "moon-gray": "#F2F2F2",
                "lemonade-yellow": "#F4E27E",
            },
        },
    },
    plugins: [
        "prettier-plugin-tailwindcss",
        require("tailwind-scrollbar-hide"),
    ],
};
