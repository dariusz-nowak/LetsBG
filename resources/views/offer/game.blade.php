@extends('layouts.main')

@section('content')


<div class="text-center">
  Produkt <br><br>
  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem deleniti a, ex odit laudantium ipsam minus maxime
  repellat sit culpa, labore sapiente, voluptatibus modi facere! Error at expedita sed voluptate. <br><br>
</div>

<div class="py-10 text-center">
  <p class="py-2">{{ $game->name }}</p>
  <p class="py-2">{{ $game->description }}</p>
  <p class="py-2">{{ $game->short_description }}</p>
  <p class="py-2">{{ $game->languages }}</p>
  <p class="py-2">{{ $game->image }}</p>
  <p class="py-2">{{ $game->price }} {{ $game->price_currency }}</p>
</div>

@endsection
