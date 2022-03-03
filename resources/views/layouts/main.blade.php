<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('app.name', 'LetsBG') }}</title>
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
  <header>
    @include('shared.header')
  </header>
  <div class="fixed top-0 left-0 h-screen w-full bg-slate-100"></div>
  <div class="content relative top-16" style="min-height: calc(100vh - 360px)">
    <div class="max-w-screen-xl pt-10 m-auto">
      @if ($errors->any())
      <div class="messages mb-10">
        @include('shared.errors')
      </div>
      @endif
      @yield('content')
    </div>
  </div>
  <footer>
    <div class="relative top-14 w-full mt-10 bg-gray-800 text-white">
      <div class="max-w-screen-lg pt-14 pb-20 m-auto">
        {{-- @include('shared.footer') --}}
      </div>
    </div>
  </footer>
  <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
