@foreach ($bestsellers as $game)
<div class="relative flex flex-col justify-between basis-full md:basis-1/2 lg:basis-1/4 lg:-mx-4" style="">
  @include('shared.product')
</div>
@endforeach
<div class="text-right w-full h-full ">
  <a href="{{ route('offer.search', ['sort' => 'bestsellers']) }}" class="block p-2">Show more...</a>
</div>
