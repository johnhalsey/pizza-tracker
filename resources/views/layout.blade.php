<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>Pizza Orders</title>
</head>
<body>
<div id="app">
    @yield('content')
</div>
</body>
</html>
