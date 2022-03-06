@extends('layouts.main')

@section('content')


{{-- <div class="text-center">
  <p class="py-2">{{ $game->name }}</p>
  <p class="py-2"></p>
  <p class="py-2">{{ $game->short_description }}</p>
  <p class="py-2">{{ $game->languages }}</p>
  <p class="py-2">{{ $game->image }}</p>
  <p class="py-2">{{ $game->price }} {{ $game->price_currency }}</p>
</div> --}}

<div class="product flex flex-col text-center font-bold">
  <div class="name h-14">
    <h1 class="relative top-1/2 -translate-y-1/2 block">{{ $game->name }}</h1>
  </div>
  <div>
    <div class="carousel">
      <div class="image">
        <img src="{{ $game->image }}" alt="" class="w-full">
      </div>
      <div class="thumbnails">

      </div>
    </div>
    <div class="informations">
      <p class="short-description"></p>
      <div class="language"></div>
      <div class="producer"></div>
      <div class="price"></div>
      <div class="buttons">
        <button class="w-full bg-gray-50 hover:bg-gray-700 hover:text-white transition-all">
          @if (Auth::check() && !$game->users->isEmpty())
          <a href="{{ route('library.show') }}">
            <input type="submit" value="Show Library" class="block w-full py-2 cursor-pointer">
          </a>
          @elseif ($game->price == 0)
          <form action="
              @if (Auth::check()) {{ route('game.add', ['game' => $game]) }}" method="post">
            @csrf
            @else {{ route('login') }}" method="get"> @endif
            <input type="submit" value="Add to Library" class="block w-full py-2 cursor-pointer">
          </form>
          @elseif (session('cartItems') && in_array($game->id, session('cartItems')))
          <a href="{{ route('cart.show') }}">
            <input type="submit" value="Show cart" class="block w-full py-2 cursor-pointer">
          </a>
          @else
          <form action="{{ route('cart.add', ['game' => $game->id]) }}" method="post">
            @csrf
            <input type="submit" value="Add to cart" class="block w-full py-2 cursor-pointer">
          </form>
          @endif
        </button>
      </div>
    </div>
  </div>
  <div class="description">
    {{ $game->description }}
  </div>
</div>

@endsection
