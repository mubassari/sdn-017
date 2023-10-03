const mix = require("laravel-mix");
const path = require("path");
const tailwindcss = require("tailwindcss");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js")
    .extract()
    .sass("resources/scss/app.scss", "public/css")
    .options({
        processCssUrls: false,
        postCss: [tailwindcss("./tailwind.config.js")],
    })
    .vue({ version: 3 });

mix.webpackConfig({
    resolve: {
        extensions: [".*",".wasm",".mjs",".js",".jsx",".json",".vue"],
        alias: {
            "ziggy": path.resolve("vendor/tightenco/ziggy/dist/vue"),
            "~Components": path.resolve(__dirname, "resources/js/Components"),
            "~Layouts": path.resolve(__dirname, "resources/js/Layouts"),
            "~Stores": path.resolve(__dirname, "resources/js/stores"),
        },
    },
    stats: {
        children: true,
    },
});
