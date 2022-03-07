<div class="fixed w-full border-b-2 bg-zinc-50 border-gray-50 shadow-md z-50">
  <div class="flex max-w-screen-xl mx-auto px-5 pt-3 pb-2 xl:px-0">
    <div class="nav basis-5/12">
      <svg class="nav-icon h-6 w-6 text-black md:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
      <div
        class="nav-container flex flex-col absolute top-11 left-0 h-0 px-5 py-2 w-full bg-zinc-50 border-b-2 overflow-hidden invisible transition-all md:relative md:top-0 md:h-auto md:flex-row md:p-0 md:border-none md:visible">
        <a href="{{ route('homepage') }}" class="block px-2 py-1 font-semibold">Home</a>
        <a href="
        @auth {{ route('offer.show', ['language' => $userSettings->language ]) }}
        @else {{ route('offer.show') }} @endauth
        " class="block px-2 py-1 font-semibold">Offer</a>
      </div>
    </div>
    <div class="logo basis-2/12 text-center hidden md:block">
      <a href="{{ route('homepage') }}" class="block font-semibold px-4 py-1">LetsBG!</a>
    </div>
    <div class="menu basis-7/12 flex justify-end md:basis-5/12">
      <div class="favorites mx-2 py-1">
        <svg onclick="loadFavorites()" class="fav-icon h-6 w-6 text-black cursor-pointer" width="24" height="24"
          viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
          stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" />
          <rect x="2" y="6" width="20" height="12" rx="2" />
          <path d="M6 12h4m-2 -2v4" />
          <line x1="15" y1="11" x2="15" y2="11.01" />
          <line x1="18" y1="13" x2="18" y2="13.01" />
        </svg>
        <div
          class="fav-container absolute top-11 left-0 w-full h-0 px-5 py-2 bg-gray-100 border-b-2 text-right overflow-x-auto overflow-y-hidden invisible whitespace-nowrap transition-all">
        </div>
        @auth
        <script type="text/javascript">
          function loadFavorites() {
            if(!document.querySelector('.fav-icon').classList.contains('loaded')){
              document.querySelector('.fav-icon').classList.add('loaded')
              $('.fav-container').load('/library/favorites')
            }
          }
        </script>
        @else
        <script>
          function loadFavorites() {
            window.location.replace("/login");
          }
        </script>
        @endauth
      </div>
      <div class="profile mx-2 py-1">
        <svg class="user-icon h-6 w-6 text-black cursor-pointer" viewBox="0 0 24 24" fill="none" stroke="currentColor"
          stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
          <circle cx="12" cy="7" r="4" />
        </svg>
        <div
          class="user-container absolute top-11 left-0 w-full h-0 px-5 py-2 bg-gray-100 border-b-2 overflow-hidden invisible transition-all xl:px-0">
          <div class="flex justify-end max-w-screen-xl mx-auto">
            @auth
            <a href="{{ route('profile.show') }}" class="block p-2 font-semibold">Profile</a>
            <a href="{{ route('library.show') }}" class="block p-2 font-semibold">Library</a>
            <form action="{{ route('logout') }}" method="post">
              @csrf
              <button class="p-2 font-semibold">Logout</button>
            </form>
            @else
            <a href="{{ route('login') }}" class="block p-2 font-semibold">Login</a>
            <a href="{{ route('register') }}" class="block p-2 font-semibold">Register</a>
            @endauth
          </div>
        </div>
      </div>
      <div class="messages mx-2 py-1">
        <svg class="search-icon h-6 w-6 cursor-pointer text-black" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        </svg>
        <div
          class="search-container absolute top-11 left-0 py-2 w-full border-b-2 h-0 overflow-hidden invisible transition-all">
        </div>
      </div>
      <div class="cart relative mx-2 py-1">
        <a href="{{ route('cart.show') }}">
          <svg class="h-6 w-6 text-black cursor-pointer" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="9" cy="21" r="1" />
            <circle cx="20" cy="21" r="1" />
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
          </svg>
          @if (session('cartItems'))
          <p class="absolute -bottom-2 -right-3 w-5 h-5 bg-red-600 rounded-full text-center text-white text-sm">
            {{ count(session('cartItems')) }}
          </p>
          @endif
        </a>
      </div>
    </div>
  </div>
</div>
