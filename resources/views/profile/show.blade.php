@extends('layouts.main')

@section('content')

<form action="" method="get" class="accound-details flex flex-col w-full shadow-md lg:flex-row">
  <input
    class="basis-1/5 py-3  cursor-pointer hover:bg-gray-800 hover:text-white transition-all @if (!$request->page || $request->page === 'Profile informations') active @endif "
    type="submit" name='page' value="Profile informations">
  <input
    class="basis-1/5 py-3  cursor-pointer hover:bg-gray-800 hover:text-white transition-all @if ($request->page === 'Change password') active @endif"
    type="submit" name='page' value="Change password">
  <input
    class="basis-1/5 py-3  cursor-pointer hover:bg-gray-800 hover:text-white transition-all @if ($request->page === 'Two Factor Authentication') active @endif"
    type="submit" name='page' value="Two Factor Authentication">
  <input
    class="basis-1/5 py-3  cursor-pointer hover:bg-gray-800 hover:text-white transition-all @if ($request->page === 'Browser Sessions') active @endif"
    type="submit" name='page' value="Browser Sessions">
  <input
    class="basis-1/5 py-3  cursor-pointer hover:bg-gray-800 hover:text-white transition-all @if ($request->page === 'Delete Account') active @endif"
    type="submit" name='page' value="Delete Account">
</form>

<x-app-layout>
  <div class="lg:py-16">
    @if ($request->page === 'Change password')
    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
    <div class="mt-10 sm:mt-0">
      @livewire('profile.update-password-form')
    </div>
    @endif

    @elseif ($request->page === 'Two Factor Authentication')
    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
    <div class="mt-10 sm:mt-0">
      @livewire('profile.two-factor-authentication-form')
    </div>
    @endif

    @elseif ($request->page === 'Browser Sessions')
    <div class="mt-10 sm:mt-0">
      @livewire('profile.logout-other-browser-sessions-form')
    </div>

    @elseif ($request->page === 'Delete Account')
    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
    <div class="mt-10 sm:mt-0">
      @livewire('profile.delete-user-form')
    </div>
    @endif

    @else
    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
    @livewire('profile.update-profile-information-form')
    @endif
    @endif
  </div>
</x-app-layout>

@endsection
