<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Finance App</title>

        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div id="app">
            <div class="container mx-auto">
                <router-view />
            </div>
        </div>

        <script src="/js/app.js"></script>
    </body>
</html>
