@extends('layouts.main')

@section('content')
<div class="newest mb-24">
  <div class="pb-4 text-center text-xl font-semibold">
    <h1 class="text-2xl font-bold">Newest and updated games</h1>
  </div>
  <div class="offer relative flex flex-wrap justify-between">
    @foreach ($newGames as $game)
    <div class="products relative flex flex-col justify-between basis-full md:basis-1/2 lg:basis-1/4 lg:-mx-4" style="">
      @include('shared.product')
    </div>
    @endforeach
    <div class="text-right w-full h-full ">
      <a href="{{ route('offer.search', ['sort' => 'newest']) }}" class="block p-2">Show more...</a>
    </div>
  </div>
</div>

<div class="bestsellers mb-24">
  <div class="pb-4 text-center text-xl font-semibold">
    <h1 class="text-2xl font-bold">Bestsellers</h1>
  </div>
  <div class="products relative -bottom-48 opacity-0 flex flex-wrap justify-between transition-all"  style="transition-duration: 1500ms; min-height: 400px">
  </div>
</div>

<div class="promotions mb-24">
  <div class="pb-4 text-center text-xl font-semibold">
    <h1 class="text-2xl font-bold">Promotions</h1>
  </div>
  <div class="products relative -bottom-48 opacity-0 flex flex-wrap justify-between transition-all" style="transition-duration: 1500ms; min-height: 400px">
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    function loadBestsellers() {
      if(!document.querySelector('.bestsellers').classList.contains('active')) {
        if( $(window).scrollTop() + $(window).height() > document.querySelector('.bestsellers').offsetTop) {
          $('.bestsellers .products').load('/load/bestsellers')
          document.querySelector('.bestsellers').classList.add('active')
        }
      } else window.removeEventListener("scroll", loadBestsellers)
    }
    loadBestsellers()
    window.addEventListener("scroll", loadBestsellers)

    function loadPromotions() {
      if(!document.querySelector('.promotions').classList.contains('active')) {
        if ($(window).scrollTop() + $(window).height() > document.querySelector('.promotions').offsetTop) {
          $('.promotions .products').load('/load/promotions')
          document.querySelector('.promotions').classList.add('active')
        }
      } else window.removeEventListener("scroll", loadPromotions)
    }
    loadPromotions()
    window.addEventListener("scroll", loadPromotions)
  })
</script>
@endsection
