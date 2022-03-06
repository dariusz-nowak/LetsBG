@extends('layouts.main')

@section('content')



@php $gamesSections = [$newGames, $bestsellers, $promotionGames] @endphp

@foreach ($gamesSections as $key => $games)
<div class="mb-8">
  <div class="pb-4 text-center text-xl font-semibold">
    <h1 class="text-2xl font-bold">
      @if ($key == 0) Newest and updated games
      @elseif ($key == 1) Bestsellers
      @elseif ($key == 2) Promotions
      @endif
    </h1>
  </div>
  <div class="offer relative flex flex-wrap justify-between">
    @foreach ($games as $game)
    <div class="relative flex flex-col justify-between basis-full md:basis-1/2 lg:basis-1/4 lg:-mx-4" style="">
      @include('shared.product')
    </div>
    @endforeach
    <div class="text-right w-full h-full ">
      <a href="
      @if ($key == 0) {{ route('offer.search', ['sort' => 'newest']) }}
      @elseif ($key == 1) {{ route('offer.search', ['sort' => 'bestsellers']) }}
      @elseif ($key == 2) {{ route('offer.search', ['promo' => 'on']) }}
      @endif
      " class="block p-2">Show more...</a>
    </div>
  </div>
</div>
@endforeach
@endsection
