@extends('layouts.main')

@section('content')
<div class="library relative md:flex">
  <div class="list md:basis-1/4 lg:basis-1/5 xl:basis-1/6">
    <button class="relative w-full text-2xl font-bold text-center border-2 border-zinc-100 py-2 rounded bg-zinc-50">
      Game list
      <svg class="absolute top-1/2 right-4 -translate-y-1/2 h-7 w-7 text-black md:hidden" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
      </svg>
    </button>

    <div class="gamesLists active max-h-0 overflow-hidden transition-all">
      @php $favorites = $remaining = $hidden = [];
      foreach($games as $game) {
      foreach ($game->users as $user) {
      if ($user->pivot->favorite === 1) $favorites[] = $game;
      elseif ($user->pivot->hidden === 1) $hidden[] = $game;
      else $remaining[] = $game;
      }
      }
      $sortGames = [$favorites, $remaining, $hidden];
      @endphp

      @foreach ($sortGames as $key => $games)
      <div class="my-3 overflow-hidden">
        <h1 class="relative text-center border-2 border-zinc-100 rounded bg-zinc-50 cursor-pointer">
          @if ($key === 0) Favorite @elseif ($key === 1) Games @else Hidden @endif
          <svg class="arrow-down absolute top-1/2 right-4 -translate-y-1/2 h-4 w-4 text-black md:hidden" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </h1>
        <div class="games @if ($key !== 2)active @endif max-h-0 cursor-pointer transition-all">
          <ul class="mb-2">
            @foreach ($games as $game)
            <li onclick="loadGame({{ $game->id }})"
              class="p-2 text-sm border-b-2 border-zinc-100 cursor-pointer hover:bg-gray-700 hover:text-white transition-all">
              {{
              $game->name }}
            </li>
            @endforeach
          </ul>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <div class="game my-4 opacity-100 transition-all md:basis-3/4 md:ml-4 md:mt-0 lg:basis-4/5 xl:basis-5/6"></div>
  <script type="text/javascript">
    function loadGame($gameId) {
      document.querySelector('.game').style.opacity = 0;
      $('.game').load('/library/loadGameDetails/' + $gameId, function() {
        document.querySelector('.game').style.opacity = 1;
      });
    }
    loadGame('@if($gameRated){{ $gameRated }}@else{{ $favorites[0]->id }}@endif')
    document.querySelector('.list button').addEventListener('click', () => document.querySelector('.gamesLists').classList.toggle('active'))
    document.querySelectorAll('.gamesLists h1').forEach(e => e.addEventListener('click', () => e.nextElementSibling.classList.toggle('active')))
  </script>
</div>
@endsection
