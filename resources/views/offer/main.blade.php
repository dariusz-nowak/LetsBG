@extends('layouts.main')

@section('content')
<div class="flex flex-wrap md:flex-nowrap">
  <div class="filters basis-full md:basis-2/6 lg:basis-1/4 xl:basis-1/6">
    <div class="mb-4 shadow-lg bg-zinc-50 border-2 border-zinc-100">
      <div class="filters-icon relative md:hidden">
        <h1 class="text-2xl font-bold text-center border-2 border-zinc-100 py-2 rounded bg-zinc-50">Filters</h1>
        <svg class="absolute top-1/2 right-4 -translate-y-1/2 h-7 w-7 text-black" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </div>
      <form action="{{ route('offer.search') }}" method="get"
        class="filters-container max-h-0 px-4 overflow-hidden transition-all md:max-h-full">
        <fieldset class="py-2">
          <p class="pb-2 font-bold">Search</p>
          <div>
            <label class="block"><input type="text" name="phrase" class="h-8 p-1 w-full"
                value="{{ $request['phrase'] ?? '' }}"></label>
          </div>
        </fieldset>
        <fieldset class="py-2">
          <p class="pb-2 font-bold">Sort</p>
          <div>
            <select name="sort" id="" class="w-full h-8 px-2 py-0 leading-none">
              <option value="">-- Options --</option>
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
          class="block ml-auto my-2 py-1 px-4 border-2 rounded-lg cursor-pointer hover:bg-gray-700 hover:text-white transition-all">
      </form>
    </div>
  </div>
  <div class="basis-full md:basis-4/6 lg:basis-3/4 xl:basis-5/6">
    <div class="offer flex flex-wrap">
      @foreach ($games as $game)
      <div class="relative flex flex-col justify-between basis-full md:basis-1/2 lg:basis-1/3 xl:basis-1/4" style="">
        @include('shared.product')
      </div>
      @endforeach
    </div>
    <div class="flex justify-center px-2">{{ $games->onEachSide(2)->appends(['language' => $requestLanguage ??
      ''])->links() }}</div>
  </div>
</div>
@endsection
