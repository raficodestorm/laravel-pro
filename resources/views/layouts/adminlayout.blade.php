<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/adminstyle.css') }}">
</head>

<body>
  @vite(['resources/js/app.js'])
  @include('components.adminsidebar')
  @include('components.adminnavbar')

  <div>
    @yield('content')
  </div>
  @include('components.adminfooter')
  <script src="{{ asset('js/admin.js') }}"></script>
</body>

</html>