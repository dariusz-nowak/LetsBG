@extends('layouts.main')

@section('content')
<div class="text-center">
  Library <br><br>
  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem deleniti a, ex odit laudantium ipsam minus maxime
  repellat sit culpa, labore sapiente, voluptatibus modi facere! Error at expedita sed voluptate. <br><br>
</div>


<div class="library flex flex-wrap justify-around">
  @foreach ($games as $game)
  <div
    class="relative mb-4 flex flex-col shadow-lg @foreach ($game->users as $user) {{ !$user->pivot->favorite ? (!$user->pivot->hidden ? '' : 'order-last') : 'order-first'}} @endforeach"
    style="flex-basis:24%">
    <div class="flex flex-col justify-between h-full">
      <div>
        <p class="text-center text-base font-bold hover:scale-110 transition-all h-14"><a
            href="{{ route('offer.gameDetails', ['game' => $game->id . ',' . $game->name]) }}"
            class="relative top-1/2 -translate-y-1/2 block p-4">{{ $game->name }}</a>
        </p>
        <div class="relative">
          <img src="{{ $game->image }}" alt="">
        </div>
      </div>
    </div>
    <div class="flex">
      <form action="{{ route('library.checkGameStatus', ['game' => $game, 'status' => 'fav']) }}" method="post"
        class="basis-1/6 bg-gray-50 hover:bg-gray-700 transition-all">
        @csrf
        <button class="block w-full py-2">
          <svg
            class="relative left-1/2 -translate-x-1/2 h-6 w-6 @foreach ($game->users as $user) {{ !$user->pivot->favorite ? 'text-black' : 'text-yellow-500'}} @endforeach"
            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
            stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" />
            <path
              d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z" />
          </svg>
        </button>
      </form>
      <button class="basis-4/6 bg-gray-50 hover:bg-gray-700 hover:text-white transition-all">
        <a href="" class="block py-2">Join to the lobby</a>
      </button>
      <form action="{{ route('library.checkGameStatus', ['game' => $game, 'status' => 'hid']) }}" method="post"
        class="basis-1/6 bg-gray-50 hover:bg-gray-700 hover:text-white transition-all">
        @csrf
        <button class="w-full block py-2">
          <svg
            class="relative left-1/2 -translate-x-1/2 h-6 w-6 @foreach ($game->users as $user) {{ !$user->pivot->hidden ? 'text-black' : 'text-red-500'}} @endforeach"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
          </svg>
        </button>
      </form>
    </div>
  </div>
  @endforeach
</div>

@endsection
