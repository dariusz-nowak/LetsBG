<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('app.name', 'LetsBG') }}</title>
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
  test
  <header>
    @include('shared.header')
  </header>
  <div class="content relative top-14" style="min-height: calc(100vh - 360px)" class="">
    @if ($_SERVER['REQUEST_URI'] === '/')
    <div class="banner relative shadow-lg">
      <div class="image w-full bg-center bg-cover brightness-50"
        style="height: calc(125vh/2);background-image: url('images/banner.png')">
      </div>
      <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full text-center text-zinc-50">
        <h1 class="text-4xl font-bold lg:text-7xl">Let's boardgame!</h1>
        <p class="py-4 text-3xl">Check your skills, play and have fun!</p>
      </div>
    </div>
    @endif
    <div class="max-w-screen-xl m-auto pt-10 px-4 xl:px-0">
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
      <div class="max-w-screen-xl pt-14 pb-20 m-auto">
        @include('shared.footer')
      </div>
    </div>
  </footer>
  <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
