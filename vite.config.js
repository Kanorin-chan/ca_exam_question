import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: '0.0.0.0',     // ← VERY IMPORTANT
        port: 5173,
        strictPort: true,
        hmr: {
            host: 'caexamquestion.test',   // ← your Homestead domain
            protocol: 'http',
            port: 5173,
        },
    },

    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js',
                "resources/css/luvi-ui.css"],
            refresh: true,
        }),
    ],
});
