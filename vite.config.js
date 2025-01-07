import laravel from "laravel-vite-plugin";
import { defineConfig } from "vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/js/app.js",
                "resources/js/vendor/swiper-home.js",
                "resources/js/vendor/swiper-recipe.js",
                "resources/css/app.css",
                "resources/css/filament/admin/theme.css",
                "resources/js/tiptap/extensions.js",
                "resources/css/tiptap/extensions.css",
            ],
            refresh: true,
        }),
    ],
});
