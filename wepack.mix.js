const mix = require('laravel-mix');

// Example: Copy fonts from node_modules to public/fonts
mix.copy('node_modules/admin_assets/icons/themify-icons/fonts', 'public/fonts');
