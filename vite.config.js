import laravel from "laravel-vite-plugin";
import { defineConfig } from "vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/vendor/swiper-home.js",
                "resources/js/vendor/swiper-recipe.js",
                // 'resources/js/vendor/aos-home.js',
            ],
            refresh: true,
        }),
    ],
});
