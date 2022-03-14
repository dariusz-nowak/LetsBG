<h1 class="relative w-full my-4 px-4 text-center text-xl md:mt-0 md:text-2xl">
  <form action="{{ route('library.checkGameStatus', ['game' => $game, 'status' => 'fav']) }}" method="post"
    class="absolute top-1/2 left-0 -translate-y-1/2 hover:bg-gray-700 transition-all">
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
  <a href="{{ route('offer.gameDetails', ['game' => $game->id . ',' . $game->name]) }}" class="md:font-bold">{{
    $game->name }}</a>
  <form action="{{ route('library.checkGameStatus', ['game' => $game, 'status' => 'hid']) }}" method="post"
    class="absolute top-1/2 right-0 -translate-y-1/2 hover:bg-gray-700 hover:text-white transition-all">
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
</h1>
<div class="details relative">
  <a href="{{ route('game.lobby', ['game' => $game->id]) }}"
    class="block w-full text-lg font-semibold text-center border-2 border-zinc-100 my-4 py-2 rounded bg-zinc-50 hover:bg-gray-700 hover:text-white transition-all md:mx-auto">Join
    lobby</a>
  <div class="description">{{ $game->description }}</div>
  <div class="rate">
    <div class="stars">
      <form action="" method="post">
        @csrf
        <div class="stars flex flex-row-reverse justify-end">
          <div class="star">
            <label class="cursor-pointer">
              <svg class="@if ($rate > 5) text-yellow-200 @endif" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" />
                <path
                  d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z" />
              </svg>
              <input type="submit" value="5" class="hidden">
            </label>
          </div>
          <div class="star">
            <label class="cursor-pointer">
              <svg class="@if ($rate > 4) text-yellow-200 @endif" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" />
                <path
                  d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z" />
              </svg>
              <input type="submit" value="4" class="hidden">
            </label>
          </div>
          <div class="star">
            <label class="cursor-pointer">
              <svg class="@if ($rate > 3) text-yellow-200 @endif" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" />
                <path
                  d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z" />
              </svg>
              <input type="submit" value="3" class="hidden">
            </label>
          </div>
          <div class="star">
            <label class="cursor-pointer">
              <svg class="@if ($rate > 2) text-yellow-200 @endif" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" />
                <path
                  d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z" />
              </svg>
              <input type="submit" value="2" class="hidden">
            </label>
          </div>
          <div class="star">
            <label class="cursor-pointer">
              <svg class="@if ($rate > 1) text-yellow-200 @endif" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" />
                <path
                  d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z" />
              </svg>
              <input type="submit" value="1" class="hidden">
            </label>
          </div>
        </div>
      </form>
    </div>
    <div class="comment">
      <form action="" method="post">
        <textarea name="comment" cols="30" rows="10" class="py-4">{{ $comment }}</textarea>
        <input type="submit" value="Submit">
      </form>
    </div>
  </div>
</div>
