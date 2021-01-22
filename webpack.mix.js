const mix = require("laravel-mix");
const Dotenv = require("dotenv-webpack");

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

mix.webpackConfig({
    resolve: {
        extensions: [".js", ".vue"],
        alias: {
            "@": __dirname + "/resources/js",
            "~": __dirname + "/resources/images"
        }
    },
    plugins: [new Dotenv()]
});

mix.js("resources/js/main.js", "public/js")
    .sass("resources/sass/main.scss", "public/css")
    .copyDirectory("resources/images", "public/images")
    .version();
