<div class="product flex flex-col h-full mx-2 mb-5 bg-zinc-50">
  <div class="name">
    <p class="text-center font-bold hover:scale-110 transition-all h-14"><a
        href="{{ route('offer.gameDetails', ['game' => $game->id . ',' . $game->name]) }}"
        class="relative top-1/2 -translate-y-1/2 block">{{ $game->name }}</a>
    </p>
  </div>
  <div class="image relative">
    <img src="{{ $game->image }}" alt="" class="w-full">
    @if (Auth::check() && !$game->users->isEmpty())
    <p class="absolute top-0 right-0 m-2 px-4 py-2 bg-red-700 text-zinc-50 rounded">Owned
    </p>
    @endif
    <div class="absolute bottom-0 flex flex-wrap justify-end w-full text-sm">
      @foreach ($game->genres as $genre)
      <button class="mx-1 my-2 rounded bg-zinc-50 hover:bg-gray-700 hover:text-white transition-all"><a
          href="{{ route('offer.search') . '?' . $genre->name . '=category' }}" class="block px-2 py-1">{{
          $genre->name }}</a></button>
      @endforeach
    </div>
  </div>
  <div class="description basis-full mx-4 my-2">
    <p class="text-sm text-center">{{ $game->short_description }}</p>
  </div>
  <div class="informations mx-4 my-2">
    <div class="language flex justify-between">
      <p>Language:</p>
      <p>{{ $game->language }}</p>
    </div>
    <div class="producer flex justify-between">
      <p class="">Producer:</p>
      @foreach ($game->producers as $producer)
      <p>{{ $producer->name }}</p>
      @endforeach
    </div>
    <div class="price flex justify-between">
      <p class="">Price:</p>
      @if ($game->price == 0)
      <p>Free</p>
      @else
      <p>{{ number_format($game->price, 2) }} {{ $game->price_currency }}</p>
      @endif
    </div>
  </div>
  <div class="buttons">
    <div class="flex border-t-2 border-zink-50 ">
      <button class="basis-1/2 bg-zinc-50 hover:bg-gray-700 hover:text-white transition-all"><a
          href="{{ route('offer.gameDetails', ['game' => $game->id . '?game=' . $game->name]) }}"
          class="block py-2">Details</a>
      </button>
      <button class="basis-1/2 bg-gray-50 hover:bg-gray-700 hover:text-white transition-all">
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
