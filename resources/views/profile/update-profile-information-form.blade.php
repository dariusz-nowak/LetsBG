<x-jet-form-section submit="updateProfileInformation">
  <x-slot name="title">
    {{ __('Profile Information') }}
  </x-slot>

  <x-slot name="description">
    {{ __('Update your account\'s profile information and email address.') }}
  </x-slot>

  <x-slot name="form">
    <!-- Profile Photo -->
    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
    <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
      <!-- Profile Photo File Input -->
      <input type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

      <x-jet-label for="photo" value="{{ __('Photo') }}" />

      <!-- Current Profile Photo -->
      <div class="mt-2" x-show="! photoPreview">
        <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
          class="rounded-full h-20 w-20 object-cover">
      </div>

      <!-- New Profile Photo Preview -->
      <div class="mt-2" x-show="photoPreview" style="display: none;">
        <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
        </span>
      </div>

      <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
        {{ __('Select A New Photo') }}
      </x-jet-secondary-button>

      @if ($this->user->profile_photo_path)
      <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
        {{ __('Remove Photo') }}
      </x-jet-secondary-button>
      @endif

      <x-jet-input-error for="photo" class="mt-2" />
    </div>
    @endif

    <!-- Name -->
    <div class="col-span-6 sm:col-span-4">
      <x-jet-label for="name" value="{{ __('Username') }}" />
      <x-jet-input id="name" type="text" class="mt-1 block w-full border-gray-300 rounded-md" wire:model.defer="state.name" autocomplete="name" />
      <x-jet-input-error for="name" class="mt-2" />
    </div>

    <!-- Email -->
    <div class="col-span-6 sm:col-span-4">
      <x-jet-label for="email" value="{{ __('Email') }}" />
      <x-jet-input id="email" type="email" class="mt-1 block w-full border-gray-300 rounded-md" wire:model.defer="state.email" />
      <x-jet-input-error for="email" class="mt-2" />
    </div>
  </x-slot>

  <x-slot name="actions">
    <x-jet-action-message class="mr-3" on="saved">
      {{ __('Saved.') }}
    </x-jet-action-message>

    <x-jet-button wire:loading.attr="enabled" wire:target="photo">
      {{ __('Save') }}
    </x-jet-button>
  </x-slot>
</x-jet-form-section>
<div class="md:grid md:grid-cols-3 md:gap-6 mt-20">
  <div class="md:col-span-1 flex justify-between">
    <div class="px-4 sm:px-0">
      <h3 class="text-lg font-medium text-gray-900">User Information</h3>
      <p class="mt-1 text-sm text-gray-600">Update your account's user information.</p>
    </div>
  </div>
  <form action="{{ route('settings.updateUserInformations') }}" method="post" class="mt-5 md:mt-0 md:col-span-2">
    @csrf
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
      <div class="flex flex-wrap">
        <label for="fname" class="basis-1/2 pr-4 pb-4 font-medium text-sm text-gray-700">First name<input type="text" name="fname" class="block w-full border-gray-300 rounded-md"></label>
        <label for="lname" class="basis-1/2 pr-4 pb-4 font-medium text-sm text-gray-700">Last name<input type="text" name="lname" class="block w-full border-gray-300 rounded-md"></label>
        <label for="phone" class="basis-1/2 pr-4 pb-4 font-medium text-sm text-gray-700">Phone<input type="tel" name="phone" class="block w-full border-gray-300 rounded-md"></label>
        <label for="currency" class="basis-1/4 pr-4 pb-4 font-medium text-sm text-gray-700">
          Currency
          <select name="currency" class="block w-full border-gray-300 rounded-md">
            <option value="USD">USD</option>
            <option value="PLN">PLN</option>
          </select>
        </label>
        <label for="language" class="basis-1/4 pr-4 pb-4 font-medium text-sm text-gray-700">
          Language
          <select name="language" class="block w-full border-gray-300 rounded-md">
            <option value="english">English</option>
            <option value="polish">Polish</option>
          </select>
        </label>
        <label for="address" class="basis-3/4 pr-4 pb-4 font-medium text-sm text-gray-700">Address<input type="text" name="address" class="block w-full border-gray-300 rounded-md"></label>
        <label for="pcode" class="basis-1/4 pr-4 pb-4 font-medium text-sm text-gray-700">Post Code<input type="text" name="pcode" class="block w-full border-gray-300 rounded-md"></label>
        <label for="city" class="basis-1/2 pr-4 pb-4 font-medium text-sm text-gray-700">City<input type="text" name="city" class="block w-full border-gray-300 rounded-md"></label>
        <label for="country" class="basis-1/2 pr-4 pb-4 font-medium text-sm text-gray-700">Country<input type="text" name="country" class="block w-full border-gray-300 rounded-md"></label>
      </div>
    </div>
    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
      <input type="submit" value="Save" class="px-4 py-2 cursor-pointer bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-gray-700 transition">
    </div>
  </form>
</div>
