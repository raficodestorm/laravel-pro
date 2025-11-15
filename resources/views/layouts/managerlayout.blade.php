<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Runstar-Counter-manager</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('./css/manager/managerstyle.css') }}">
  <link rel="stylesheet" href="{{ asset('./css/admin/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('./css/admin/sidebar.css') }}">
</head>

<body>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @include('components.managersidebar')
  <main>
    @include('components.adminnavbar')
    <div>
      @yield('content')
    </div>
    @include('components.adminfooter')
  </main>

  @yield('scripts')
  <script src="{{ asset('./js/sidebar.js') }}"></script>
  <script src="{{ asset('./js/manager.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
  </script>
</body>

</html>