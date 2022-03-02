@extends('layouts.main')

@section('content')
<div class="text-center">
  Oferta <br><br>
  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem deleniti a, ex odit laudantium ipsam minus
  maxime
  repellat sit culpa, labore sapiente, voluptatibus modi facere! Error at expedita sed voluptate.<br><br>
</div>

<div class="flex">
  <div class="filters basis-1/6">
    <div class="px-4 pb-4 shadow-lg">
      <form action="{{ route('offer.search') }}" method="get">
        <fieldset class="py-2">
          <p class="pb-2 font-bold">Search</p>
          <div>
            <label class="block"><input type="text" name="phrase" class="h-8 p-1"
                value="{{ $request['phrase'] ?? '' }}"></label>
          </div>
        </fieldset>
        <fieldset class="py-2">
          <p class="pb-2 font-bold">Sort</p>
          <div>
            <select name="sort" id="" class="w-full h-8 px-2 py-0 leading-none">
              <option value="">-- Choose an option --</option>
              <option value="newest" @php if (isset($request['sort']) && $request['sort']==='newest' ) { echo 'selected'
                ; } @endphp>Newest</option>
              <option value="bestsellers" @php if (isset($request['sort']) && $request['sort']==='bestsellers' ) {
                echo 'selected' ; } @endphp>Bestsellers</option>
              <option value="nameAsc" @php if (isset($request['sort']) && $request['sort']==='nameAsc' ) {
                echo 'selected' ; } @endphp>Name, Ascending</option>
              <option value="nameDesc" @php if (isset($request['sort']) && $request['sort']==='nameDesc' ) {
                echo 'selected' ; } @endphp>Name, Descending</option>
              <option value="priceAsc" @php if (isset($request['sort']) && $request['sort']==='priceAsc' ) {
                echo 'selected' ; } @endphp>Price, Ascending</option>
              <option value="priceDesc" @php if (isset($request['sort']) && $request['sort']==='priceDesc' ) {
                echo 'selected' ; } @endphp>Price, Descending</option>
            </select>
          </div>
        </fieldset>
        <fieldset class="py-2">
          <p class="pb-2 font-bold">Categories</p>
          <div>
            @foreach ($genres as $genre)
            <label class="block">
              <input type="checkbox" name="{{ $genre->name }}" value="category" @php if (isset($request[$genre->name]))
              echo 'checked' @endphp>
              {{ $genre->name }}
            </label>
            @endforeach
          </div>
        </fieldset>
        <fieldset class="py-2">
          <p class="pb-2 font-bold">Producer</p>
          <div>
            @foreach ($producers as $producer)
            <label class="block">
              <input type="checkbox" name="{{ $producer->name }}" value="producer" @php if
                (isset($request[$producer->name])) {
              echo 'checked';
              } @endphp>
              {{ $producer->name }}
            </label>
            @endforeach
          </div>
        </fieldset>
        <fieldset class="py-2">
          <p class="pb-2 font-bold">Price</p>
          <div>
            <label class="free"><input type="checkbox" name="free_only" id="" @php if (isset($request['free_only'])) {
                echo 'checked' ; } @endphp>
              Free Only</label>
            <label class="prices block mt-2">
              <input type="number" name="min_price" class="w-16 h-6 p-1 appearance-none"
                value="{{ $request['min_price'] ?? '' }}"> -
              <input type="number" name="max_price" class="w-16 h-6 p-1 appearance-none"
                value="{{ $request['max_price'] ?? '' }}">
            </label>
          </div>
        </fieldset>
        <fieldset class="py-2">
          <p class="pb-2 font-bold">Language</p>
          <div>
            @php $languages = [] @endphp
            @foreach ($games as $game)
            @if (!in_array($game->language, $languages))
            @php $languages[] = $game->language @endphp
            @endif
            @endforeach
            @php asort($languages) @endphp
            @foreach ($languages as $language)
            <label class="block">
              <input type="checkbox" name="{{ $language }}" value="language" @php if (isset($request[$language]) ||
                isset($requestLanguage)) echo 'checked' @endphp>
              {{ $language }}
            </label>
            @endforeach
          </div>
        </fieldset>
        <fieldset class="py-2">
          <p class="pb-2 font-bold">Min age</p>
          <div>
            @php $ages = [] @endphp
            @foreach ($games as $game)
            @if (!in_array($game->min_age, $ages))
            @php $ages[] = $game->min_age @endphp
            @endif
            @endforeach
            @php natsort($ages) @endphp
            @foreach ($ages as $age)
            <label class="block">
              <input type="checkbox" name="{{ $age }}" value="age" @php if (isset($request[$age])) echo 'checked'
                @endphp>
              {{ $age }}
            </label>
            @endforeach
          </div>
        </fieldset>
        <fieldset>
          <p class="pb-2 font-bold">Other</p>
          <div class="flex flex-col">
            <label>
              <input type="checkbox" name="promo" @php if (isset($request['promo'])) echo 'checked' @endphp> Promotions
            </label>
            @auth
            <label>
              <input type="checkbox" name="owned" @php if (isset($request['owned'])) echo 'checked' @endphp> Show Owned
            </label>
            @endauth
          </div>
          <div class="h-0 overflow-hidden transition-all">
          </div>
        </fieldset>
        <input type="submit" value="Submit"
          class="block ml-auto py-1 px-4 border-2 rounded-lg cursor-pointer hover:bg-gray-700 hover:text-white transition-all">
      </form>
    </div>
  </div>
  <div class="basis-5/6 pl-6">
    <div class="offer flex flex-wrap justify-between">
      @foreach ($games as $game)
      <div class="relative mb-4 flex flex-col justify-between shadow-lg" style="flex-basis:32%">
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
              @if (!in_array($game->id ,session('cartItems')))
              <form action="{{ route('cart.add', ['game' => $game->id]) }}" method="post">
                @csrf
                <input type="submit" value="Add to cart" class="block w-full py-2 cursor-pointer">
              </form>
              @else
              <p class="absolute top-0 -left-1 -rotate-12 rounded px-4 py-1 bg-red-700 text-white">In cart</p>
              <a href="{{ route('cart.show') }}">Continue order</a>
              @endif
              @endif
            </button>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="flex justify-end">{{ $games->onEachSide(2)->links() }}</div>
  </div>
</div>
@endsection
