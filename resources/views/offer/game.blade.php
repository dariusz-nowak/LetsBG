@extends('layouts.main')

@section('content')
<div class="product flex flex-col text-center">
  <div class="name h-14">
    <h1 class="relative top-1/2 -translate-y-1/2 block font-bold md:text-2xl">{{ $game->name }}</h1>
  </div>
  <div class="flex flex-col md:flex-row">
    <div class="carousel md:basis-1/2 lg:basis-2/5">
      <div class="image relative h-80">
        <p onclick="changeActiveImage('left')"
          class="arrow-left absolute top-0 left-0 w-1/6 h-full cursor-pointer transition-all z-10">
          <svg class="relative top-1/2 -translate-y-1/2 h-10 w-full text-black center" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
        </p>
        <img src="{{ $game->image }}" alt=""
          class="relative top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 max-h-full cursor-pointer">
        <p onclick="changeActiveImage('right')"
          class="arrow-right absolute top-0 right-0 w-1/6 h-full cursor-pointer transition-all z-10">
          <svg class="relative top-1/2 -translate-y-1/2 h-10 w-full text-black center" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </p>
      </div>
      <div class="thumbnails relative">
        <p onclick="moveThumbnails('left')"
          class="arrow-left absolute top-0 left-0 w-8 h-full cursor-pointer transition-all z-10">
          <svg class="relative top-1/2 -translate-y-1/2 h-6 w-full text-black center" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
        </p>
        <div class="relative left-0 whitespace-nowrap overflow-hidden -mx-2" style="font-size:0">
          <div class="images relative left-0 transition-all max-h-20">
            @foreach ($game->screenshot as $key => $screenshot)
            <div onclick="loadScreen({{ $key }})" class="w-1/3 h-20 inline-block cursor-pointer"
              style="font-size:0;letter-spacing:-1px">
              <img src="{{ $screenshot->thumbnail }}"
                class="relative top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 block max-h-full p-2">
            </div>
            @endforeach
          </div>
        </div>
        <p onclick="moveThumbnails('right')"
          class="arrow-right absolute top-0 right-0 w-8 h-full cursor-pointer transition-all z-10">
          <svg class="relative top-1/2 -translate-y-1/2 h-6 w-full text-black center" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </p>
      </div>
    </div>
    @php $images = [] @endphp
    @foreach ($game->screenshot as $screenshot)
    @php $images[] = $screenshot->url @endphp
    @endforeach
    <script type="text/javascript">
      const images = {!! json_encode($images) !!}
      let activeImage = 0
      let thumbnailsPosition = 0
      function loadScreen(key) {
        document.querySelector('.image img').src = images[key]
        let activeImage = key
      }
      function changeActiveImage(arrow) {
        if(arrow === 'left' && activeImage > 0) activeImage--
        else if(arrow === 'right' && activeImage < images.length - 1) activeImage++
        document.querySelector('.image img').src = images[activeImage]
      }
      function moveThumbnails(arrow) {
        if(arrow === 'left' && thumbnailsPosition > 0) thumbnailsPosition--
        else if(arrow === 'right' && thumbnailsPosition < images.length - 3) thumbnailsPosition++
        document.querySelector('.images').style.left = -Math.round(document.querySelector('.images').clientWidth / 3) * thumbnailsPosition + 'px'
      }
    </script>
    <div class="informations flex flex-col justify-between md:basis-1/2 md:pl-4 lg:basis-3/5">
      <div class="short-description my-2 md:w-11/12 md:h-full md:my-0 md:mx-auto">
        <p class="md:relative md:top-1/2 md:-translate-y-1/2 md:block">{{ $game->short_description }}</p>
      </div>
      <div class="details my-2 md:w-10/12 md:my-0 md:mx-auto lg:w-1/2 lg:mr-4">
        <div class="language flex justify-between">
          <p>Language</p>
          <p>{{ $game->language }}</p>
        </div>
        <div class="producer flex justify-between">
          <p>Producers</p>
          <p>
            @foreach ($game->producers as $producer)
            <span>{{ $producer->name }}</span>
            @endforeach
          </p>
        </div>
        <div class="price flex justify-between">
          <p>Price</p>
          <p>{{ $game->price }} {{ $game->price_currency }}</p>
        </div>
        <div class="buttons mt-4">
          <button class="w-full bg-gray-50 hover:bg-gray-700 hover:text-white transition-all">
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
            @elseif (session('cartItems') && in_array($game->id, session('cartItems')))
            <a href="{{ route('cart.show') }}">
              <input type="submit" value="Show cart" class="block w-full py-2 cursor-pointer">
            </a>
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
  </div>
  <div class="description my-4">
    <h1 class="w-full text-center text-3xl py-4">Description</h1>
    {{ $game->description }}
  </div>
  <div class="comments py-4">
    @foreach ($comments as $comment)
    <div class="comment relative my-4 border-2 rounded-xl">
      <div class="header flex flex-col border-b-2 md:flex-row">
        <div class="user basis-1/2">
          <p class="user px-4 py-2 text-left">{{ $comment['user'] }}</p>
        </div>
        <div class="likes basis-1/2 flex justify-end">
          <p class="likes p-2 text-left">{{ $comment['likes'] }} likes</p>
          <svg onclick="like(this, {{ $comment['commentId'] }})"
            class="h-8 w-8 m-1 @if ($comment['like']) text-yellow-400 @endif" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
          </svg>
        </div>
      </div>
      <p class="comment px-4 py-2">{{ $comment['comment'] }}</p>
    </div>
    @endforeach
    <script type="text/javascript">
      function like(svg, id) {
        $(svg.parentElement).load('/offer/like/' + id)
        svg.remove()
      }
    </script>
  </div>
</div>
@endsection
