<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('app.name', 'LetsBG') }}</title>

  <link rel="stylesheet" href="{{ mix('css/app.css') }}">

  <style>
    body {
      height: 110vh;
    }
  </style>
</head>

<body>
  <header>
    @include('shared.header')
  </header>

  <div class="max-w-screen-lg m-auto pt-24">
    @yield('content')
  </div>

  @if ($errors->any())
  <div class="errors fixed bottom-0 right-0 pb-6 pr-6 transition-all duration-700 opacity-1">
    @foreach ($errors->all() as $error)
    <p class="bg-red-400 ml-auto mr-2 my-4 px-6 py-2 w-fit rounded-xl text-lg text-white shadow-xl">{{$error}}</p>
    @endforeach
  </div>
  @endif

  <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
