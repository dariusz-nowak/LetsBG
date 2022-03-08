@extends('layouts.main')

@section('content')

<div class="product flex flex-col text-center">
  <div class="name h-14">
    <h1 class="relative top-1/2 -translate-y-1/2 block font-bold">{{ $game->name }}</h1>
  </div>
  <div>
    <div class="carousel">
      <div class="image">
        <img src="{{ $game->image }}" alt="" class="w-full">
      </div>
      <div class="thumbnails">

      </div>
    </div>
    <div class="informations my-4">
      <div class="language flex justify-between">
        <p>Language</p>
        <p>{{ $game->language }}</p>
      </div>
      <div class="producer flex justify-between">
        <p>Producers</p>
        <p>
          @foreach ($game->producers as $producer)
          <span>{{ $producer->name }}</span>
          @endforeach
        </p>
      </div>
      <div class="price flex justify-between">
        <p>Price</p>
        <p>{{ $game->price }} {{ $game->price_currency }}</p>
      </div>
      <div class="buttons mt-4">
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
  <div class="description my-4">
    {{ $game->description }}
  </div>
</div>

@endsection
