<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/userstyle.css') }}">
</head>

<body>
    @vite(['resources/js/app.js'])
    @include('components.navbar')

    <div>
        @yield('content')
    </div>
    @include('components.footer')
</body>

</html>