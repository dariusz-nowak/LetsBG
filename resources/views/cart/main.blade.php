@extends('layouts.main')

@section('content')
@foreach ($products as $product)
{{dump($product)}}
@endforeach
@endsection
