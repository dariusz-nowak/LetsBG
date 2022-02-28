
<div class="flex">
  <div class="basis-1/4">
    LetsBG logo
  </div>
  <div class="basis-1/4">
    <h1 class="text-xl">Main menu</h1>
    <ul class="px-4 py-2">
      <li class="pt-1"><a href="{{ route('homepage') }}">Homepage</a></li>
      <li class="pt-1"><p class="inline text-red-400">ToDo</p> Polityka prywatności</li>
      <li class="pt-1"><p class="inline text-red-400">ToDo</p> Regulamin</li>
    </ul>
  </div>
  <div class="basis-1/4">
    <h1 class="text-xl">Products</h1>
    <ul class="px-4 py-2">
      <li class="pt-1"><a href="{{ route('offer.show') }}">Offer</a></li>
      <li class="pt-1"><p class="inline text-red-400">ToDo</p> Bestsellers</li>
      <li class="pt-1"><p class="inline text-red-400">ToDo</p> Promotions</li>
    </ul>
  </div>
  @auth
  <div class="basis-1/4">
    <h1 class="text-xl">User</h1>
    <ul class="px-4 py-2">
      <li class="pt-1"><a href="{{ route('profile.show') }}">Account</a></li>
      <li class="pt-1"><a href="{{ route('library.show') }}">Library</a></li>
      <li class="pt-1"><p class="inline text-red-400">ToDo</p> Messages</li>
    </ul>
  </div>
  @endauth
</div>
