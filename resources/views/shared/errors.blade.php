@foreach ($errors->all() as $error)
<div class="mt-2 rounded bg-red-300 opacity-85">
  <p class="inline-block px-4 py-2 text-lg">{{ $error }}</p>
</div>
@endforeach
