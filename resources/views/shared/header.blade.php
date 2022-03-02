<div class="fixed w-full px-5 pt-3 pb-2 bg-white border-b-2 border-gray-50 shadow-md z-50">
  <div class="flex max-w-screen-lg m-auto">
    <div class="w-1/2 m-1.5 font-semibold">
      LetsBG
    </div>
    <div class="w-1/2">
      <ul class="flex justify-end">
        <li class="p-1.5"><button><a href="{{ route('homepage') }}" class="font-semibold">Homepage</a></button>
        </li>
        <li class="p-1.5"><button><a href="{{ route('offer.show', ['language' => $userSettings->language]) }}"
              class="font-semibold">Offer</a></button></li>
        <li class="mx-1.5 py-1.5 border-gray-100 border-l-2"></li>
        @guest
        <li class="p-1.5"><button><a href="{{ route('login') }}" class="font-semibold">Login</a></button></li>
        <li class="p-1.5"><button><a href="{{ route('register') }}" class="font-semibold">Register</a></button></li>
        @else
        </li>
        <li class="p-1.5 font-semibold">Hello {{ Auth::user()->name; }}</li>
        <li>
          <button class="fav-games p-1.5">
            <a href="">
              <svg class="h-6 w-6 text-black" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" />
                <rect x="2" y="6" width="20" height="12" rx="2" />
                <path d="M6 12h4m-2 -2v4" />
                <line x1="15" y1="11" x2="15" y2="11.01" />
                <line x1="18" y1="13" x2="18" y2="13.01" />
              </svg>
            </a>
          </button>
          <div
            class="fav-games-menu absolute top-0 left-0 max-w-full h-0 invisible w-full mt-14 shadow-md bg-white transition-all">
            <ul
              class="overflow-x-auto overflow-y-hidden overscroll-x-contain max-w-screen-lg mx-auto text-right whitespace-nowrap">
              @if (!$favoriteGames->isEmpty())
              @foreach ($favoriteGames as $game)
              <li class="p-2 font-semibold whitespace-nowrap inline-block"><a
                  href="{{ route('game.lobby', ['game' => $game->id]) }}">{{
                  $game->name }}</a>
              </li>
              @endforeach
              @else
              <li class="p-2 font-semibold whitespace-nowrap inline-block"><a href="{{ route('library.show') }}">Add
                  games to your favorite list here</a></li>
              @endif
            </ul>
          </div>
        </li>
        <li>
          <button class="user p-1.5">
            <a href="">
              <svg class="h-6 w-6 text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                <circle cx="12" cy="7" r="4" />
              </svg>
            </a>
          </button>
          <div
            class="user-menu absolute top-0 left-0 max-w-full h-0 invisible w-full mt-14 shadow-md bg-white transition-all overflow-hidden">
            <ul class="flex justify-end max-w-screen-lg m-auto">
              <li class="p-2"><button><a href="{{ route('profile.show') }}" class="font-semibold">Account</a></button>
              </li>
              <li class="p-2"><button><a href="{{ route('library.show') }}" class="font-semibold">Library</a></button>
              </li>
              <li class="currency p-2">
                <button class="font-semibold">
                  <span class="capitalize">{{ $userSettings->currency }}</span>
                  <svg class="inline-block h-4 w-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                  </svg>
                </button>
                <div class="currency-form absolute flex flex-col h-0 overflow-hidden bg-white">
                  @foreach ($currenciesList as $currency)
                  <form action="{{ route('settings.changeCurrency', ['currency' => $currency]) }}" method="post"
                    class="w-20">
                    @csrf
                    <input type="submit" value="{{$currency}}"
                      class="p-2 w-full cursor-pointer transition-all hover:bg-gray-600 hover:text-white">
                  </form>
                  @endforeach
                </div>
              </li>
              <li class="language p-2">
                <button class="font-semibold">
                  <span class="capitalize">{{ $userSettings->language }}</span>
                  <svg class="inline-block h-4 w-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                  </svg>
                </button>
                <div class="language-form absolute flex flex-col h-0 overflow-hidden bg-white">
                  @foreach ($languagesList as $language)
                  <form action="{{ route('settings.changeLanguage', ['language' => $language]) }}" method="post"
                    class="w-20">
                    @csrf
                    <input type="submit" value="{{$language}}"
                      class="p-2 w-full cursor-pointer transition-all hover:bg-gray-600 hover:text-white">
                  </form>
                  @endforeach
                </div>
              </li>
              <li class="p-2">
                <form action="{{ route('logout') }}" method="post"> @csrf <button class="font-semibold">Logout</button>
                </form>
              </li>
            </ul>
          </div>
        </li>
        <li>
          <button class="relative p-1.5">
            <a href="{{ route('cart.show') }}">
              <svg class="h-6 w-6 text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <circle cx="9" cy="21" r="1" />
                <circle cx="20" cy="21" r="1" />
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
              </svg>
              @if (session('cartItems'))
              <p class="absolute -bottom-1 -right-1 w-5 h-5 bg-red-600 rounded-full text-white text-sm">
                {{ count(session('cartItems')) }}
              </p>
              @endif
            </a>
          </button>
        </li>
        @endguest
        <li>
          <button class="search p-1.5">
            <a href="{{ route('cart.show') }}">
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </a>
          </button>
          <div
            class="search-form absolute top-0 left-0 max-w-full h-0 invisible w-full mt-14 shadow-md bg-white transition-all overflow-hidden">
            <form action="{{ route('offer.search') }}" method="get" class="flex justify-end max-w-screen-lg m-auto">
              <input type="text" name="phrase" id="" class="h-7 w-1/4">
              <input type="submit" value="Search" class="px-4 bg-gray-700 text-white">
            </form>
          </div>
        </li>
        <li class="mx-1.5 py-1.5 border-gray-100 border-l-2"></li>
        <li>
          <button class="main p-1.5">
            <a href="">
              <svg class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
            </a>
          </button>
        </li>
        <li>
          <button class="main p-1.5">
            <a href="">
              <svg class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
              </svg>
            </a>
          </button>
        </li>
      </ul>
    </div>
  </div>
</div>
