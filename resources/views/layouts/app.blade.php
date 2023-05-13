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
  @yield('script')
  @vite(['resources/js/app.js'])

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
</body>

</html>
