<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title }}</title>
        <meta name="description" content="Painting catalog of artworks by creators from all around the world.">
    </head>

    <body>
        <div id="root"></div>

        @viteReactRefresh
        @vite('resources/js/index.jsx')
    </body>

</html>

