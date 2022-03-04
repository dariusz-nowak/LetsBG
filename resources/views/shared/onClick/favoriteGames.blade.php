<ul class="max-w-screen-xl mx-auto">
@if (!$favoriteGames->isEmpty())
  @foreach ($favoriteGames as $game)
    <li class="p-2 font-semibold whitespace-nowrap inline-block"><a href="{{ route('game.lobby', ['game' => $game->id]) }}">{{ $game->name }}</a></li>
  @endforeach
@else
<li class="p-2 font-semibold whitespace-nowrap inline-block"><a href="{{ route('library.show') }}">Add
  games to your favorite list here</a></li>
@endif
</ul>
