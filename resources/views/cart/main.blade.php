@extends('layouts.main')

@section('content')

@if (!$products)
Koszyk pusty
@else
@php $cartSections = [] @endphp
@foreach ($products as $product)
@if (!array_key_exists($product->price_currency, $cartSections))
@php $cartSections[$product->price_currency] = []; @endphp
@endif
@php array_push($cartSections[$product->price_currency], $product) @endphp
@endforeach
@foreach ($cartSections as $key => $products)
<table class="table-auto w-full mb-20">
  <thead>
    <tr>
      <th>Image</th>
      <th>Name</th>
      <th>Price</th>
      <th>remove</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($products as $product)
    <tr class="text-center">
      <td class="w-28 border-y-2 border-l-2"><img src="{{ $product->image }}" alt=""></td>
      <td class="w-4/6 px-4 py-2 border-2 border-l-0">
        <p class="pb-2 font-bold">{{ $product->name }}</p>
        <p>{{ $product->short_description }}</p>
      </td>
      <td class="px-4 py-2 border-2">{{ number_format($product->price, 2) . ' ' . $product->price_currency }}</td>
      <td class="px-4 py-2 border-2">
        <form action="{{ route('cart.remove', ['game' => $product->id]) }}" method="post">
          @csrf
          <label class="block w-full h-full cursor-pointer">
            <svg class="relative top-1/2 translate-y-1/2 h-6 w-6 m-auto text-black" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>

            <input type="submit" value="">
          </label>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
  <tfoot class="text-center">
    <tr>
      <td></td>
      <td></td>
      <td class="px-4 py-2 border-2">
        @php $sum = 0; foreach($products as $product) $sum += $product->price; echo number_format($sum, 2) . ' ' .
        array_keys($cartSections, $cartSections[$key])[0] @endphp
      </td>
      <td class="px-4 py-2 border-2">
        <form action="{{ route('cart.clear')}}" method="post">
          @csrf
          <label class="block w-full h-full">
            <input type="submit" value="Clear cart" class="cursor-pointer">
          </label>
        </form>
      </td>
    </tr>
  </tfoot>
</table>
@endforeach
<table class="table-auto w-1/2 ml-auto">
  <thead>
    <tr>
      <th>Price</th>
      <th>Currency</th>
      <th>Exchange rate</th>
      <th>Final Price</th>
    </tr>
  </thead>
  <tbody>
    @php $finalSum = 0 @endphp
    @foreach ($cartSections as $key => $products)
    @php
    $sum = 0;
    foreach($products as $product) $sum += $product->price;
    $currency = array_keys($cartSections, $cartSections[$key])[0];
    $exchangeRate = Currency::convert()->from($currency)->to('USD')->get();
    $finalPrice = round($sum * $exchangeRate, 2);
    $finalSum += $finalPrice;
    @endphp
    <tr>
      <td class="text-center border-2">{{ $sum }}</td>
      <td class="text-center border-2">{{ $currency }}</td>
      <td class="text-center border-2">{{ $exchangeRate }}</td>
      <td class="text-center border-2">{{ $finalPrice }}</td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td class="border-2 text-center">{{ $finalSum }}</td>
    </tr>
  </tfoot>
</table>
<div class="h-96"></div>
@endif

@endsection
