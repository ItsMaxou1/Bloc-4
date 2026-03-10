// vite.config.js
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    server: {
        proxy: {
            // toute requête front commençant par /api ira vers ton back Laravel
            "/api": {
                target: "http://127.0.0.1:8000",
                changeOrigin: true,
                secure: false,
            },
        },
    },
});
