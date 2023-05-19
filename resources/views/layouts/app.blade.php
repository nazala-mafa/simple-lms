<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

  <!-- Scripts -->
  @vite(['resources/sass/app.scss'])
  @livewireStyles

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  @stack('head')
</head>

<body>
  <div id="app">
    @include('layouts.navbar')

    <main class="py-4">
      @yield('content')
    </main>
  </div>

  @include('layouts.util')

  @livewireScripts
  @vite(['resources/js/app.js'])

  {{-- Show Flash Message --}}
  @if (Session::has('message'))
    <script>
      let swalPushData = {
        title: 'Congratulation!',
        body: `{{ Session::get('message') }}`,
        type: 'success'
      }
    </script>
  @elseif(Session::has('error'))
    <script>
      let swalPushData = {
        title: 'We are sorry!',
        body: `{{ Session::get('error') }}`,
        type: 'error'
      }
    </script>
  @else
    <script>
      let swalPushData = null
    </script>
  @endif

  @stack('script')

  <div style="height: 20em;"></div>
</body>

</html>
