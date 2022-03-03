@extends('layouts.main')

@section('content')
@php $gamesSections = [$newGames, $bestsellers, $promotionGames] @endphp
@foreach ($gamesSections as $key => $games)
<div class="newest">
  <div class="py-4 text-center text-xl font-semibold">
    <h1>
      @if ($key == 0) Newest and updated games
      @elseif ($key == 1) Bestsellers
      @elseif ($key == 2) Promotions
      @endif
    </h1>
  </div>
  <div class="offer flex flex-wrap justify-between">
    @foreach ($games as $game)
    <div class="relative mb-4 flex flex-col justify-between shadow-lg" style="flex-basis:24%">
      <div class="flex flex-col justify-between h-full">
        <div>
          <p class="text-center text-base font-bold hover:scale-110 transition-all h-14"><a
              href="{{ route('offer.gameDetails', ['game' => $game->id . ',' . $game->name]) }}"
              class="relative top-1/2 -translate-y-1/2 block p-4">{{ $game->name }}</a>
          </p>
          <div class="relative">
            <img src="{{ $game->image }}" alt="">
            @if (Auth::check() && !$game->users->isEmpty())
            <p class="absolute top-0 right-0 m-2 px-4 py-2 bg-red-700 text-white rounded">Owned
            </p>
            @endif
            <div class="absolute bottom-0 flex flex-wrap justify-end w-full text-xs">
              @foreach ($game->genres as $genre)
              <button
                class="mr-1 mb-1 rounded-md bg-white text-black hover:bg-gray-700 hover:text-white transition-all"><a
                  href="{{ route('offer.search') . '?' . $genre->name . '=category' }}" class="block px-2 py-1">{{
                  $genre->name }}</a></button>
              @endforeach
            </div>
          </div>
          <p class="p-2 text-sm text-center">{{ $game->short_description }}</p>
        </div>
        <div>
          <div class="flex justify-between px-3">
            <p class="">Language:</p>
            <p>{{ $game->language }}</p>
          </div>
          <div class="flex justify-between px-3">
            <p class="">Producer:</p>
            @foreach ($game->producers as $producer)
            <p>{{ $producer->name }}</p>
            @endforeach
          </div>
          <div class="flex justify-between px-3">
            <p class="">Price:</p>
            @if ($game->price == 0)
            <p>Free</p>
            @else
            <p>{{ number_format($game->price, 2) }} {{ $game->price_currency }}</p>
            @endif
          </div>
        </div>
      </div>
      <div>
        <div class="flex mt-2 border-t-2 border-neutral-100">
          <button class="basis-1/2 bg-gray-50 hover:bg-gray-700 hover:text-white transition-all"><a
              href="{{ route('offer.gameDetails', ['game' => $game->id . '?game=' . $game->name]) }}"
              class="block py-2">Details</a></button>
          <button class="basis-1/2 bg-gray-50 hover:bg-gray-700 hover:text-white transition-all">
            @if (Auth::check() && !$game->users->isEmpty())
            <a href="{{ route('library.show') }}"><input type="submit" value="Show Library"
                class="block w-full py-2 cursor-pointer"></a>
            @elseif ($game->price == 0)
            <form action="
              @if (Auth::check()) {{ route('game.add', ['game' => $game]) }}" method="post">
              @csrf
              @else {{ route('login') }}" method="get"> @endif
              <input type="submit" value="Add to Library" class="block w-full py-2 cursor-pointer">
            </form>
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
    @endforeach
  </div>
  <a href="
  @if ($key == 0) {{ route('offer.search', ['sort' => 'newest']) }}
  @elseif ($key == 1) {{ route('offer.search', ['sort' => 'bestsellers']) }}
  @elseif ($key == 2) {{ route('offer.search', ['promo' => 'on']) }}
  @endif
  " class="block w-full text-right">Show more...</a>
</div>
@endforeach
@endsection
