let mix = require("laravel-mix");

mix.js("resources/assets/js/app.js", "public/assets/js");
mix
  .sass(
    "resources/assets/sass/import.scss",
    "public/assets/css/main/main.css",
    {
      outputStyle: mix.inProduction ? "compressed" : "expanded"
    }
  )
  .options({
    processCssUrls: false // SET FALSE TO DECREASE HANG PC
  });
