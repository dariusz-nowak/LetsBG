<div class="fixed w-full px-5 pt-3 pb-2 bg-white border-b-2 border-gray-50 shadow-md z-50">
  <div class="flex max-w-screen-lg m-auto">
    <div class="w-1/2 m-1.5 font-semibold">
      logo
    </div>

    <div class="w-1/2">
      <ul class="flex justify-end">
        <li class="p-1.5"><button><a href="{{ route('homepage') }}" class="font-semibold">Homepage</a></button>
        </li>
        <li class="p-1.5"><button><a href="{{ route('offer.offer') }}" class="font-semibold">Offer</a></button></li>
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
            class="user-menu absolute top-0 left-0 max-w-full h-0 overflow-hidden w-full mt-14 shadow-md transition-all duration-300 bg-white">
            <ul class="flex justify-end max-w-screen-lg m-auto">
              <li class="p-2"><button><a href="{{ route('profile.show') }}" class="font-semibold">Account</a></button>
              </li>
              <li class="p-2"><button><a href="{{ route('library.show') }}" class="font-semibold">Library</a></button>
              </li>
              <li class="p-2"><button><a href="{{ route('logout') }}" class="font-semibold">Logout</a></button>
            </ul>
          </div>
        </li>
        <li>
          <button class="cart p-1.5">
            <a href="">
              <svg class="h-6 w-6 text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <circle cx="9" cy="21" r="1" />
                <circle cx="20" cy="21" r="1" />
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
              </svg>
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
            class="search-form absolute top-0 left-0 max-w-full h-0 overflow-hidden w-full mt-14 shadow-md transition-all duration-300 bg-white">
            <form action="{{ route('offer.search') }}" method="get" class="flex justify-end max-w-screen-lg m-auto">
              <input type="text" name="phrase" id="" class="h-7 w-1/4">
              <input type="submit" value="Search" class="px-4 bg-gray-700 text-white">
            </form>
          </div>
        </li>

      </ul>
    </div>
  </div>
</div>
