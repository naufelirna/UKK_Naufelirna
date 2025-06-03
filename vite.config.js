import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { execSync } from 'child_process';

console.log("PHP version from Vite:", execSync("php -v").toString());

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
