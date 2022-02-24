@extends('layouts.main')

@section('content')
{{ $slot }}
</main>
</div>

@stack('modals')

@livewireScripts
@endsection
