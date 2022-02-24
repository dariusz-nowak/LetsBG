@extends('layouts.main')

@section('content')
<div class="text-center">
  Library <br><br>
  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem deleniti a, ex odit laudantium ipsam minus maxime
  repellat sit culpa, labore sapiente, voluptatibus modi facere! Error at expedita sed voluptate. <br><br>
</div>

<div class="flex flex-wrap justify-around">
  @foreach ($games as $game)
  <div class="library-game relative shadow-xl my-2 cursor-pointer hover:z-10 hover:scale-125 transition-all"
    style="flex-basis:24%">
    <a href="{{ route('game.lobby', ['game' => $game->name]) }}">
      <p class="text-center bg-white rounded">{{ $game->name }}</p>
      <img src="{{ $game->image }}" alt="">
      <div class="play absolute top-0 left-0 w-full h-full bg-black opacity-0 transition-all">
        <button
          class="relative top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-10/12 h-12 z-20 text-white text-center text-xl">
          Enter the <br> {{ $game->name }} <br> lobby</button>
      </div>
    </a>
  </div>
  @endforeach
</div>

@endsection
