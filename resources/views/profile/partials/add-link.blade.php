<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Add Link') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("After adding the link , Your link will be displayed in short form") }}
        </p>
    </header>

    <form method="post" action="{{ route('user.create') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <x-input-label for="original_url" :value="__('original_url')" />
            <x-text-input id="original_url" name="original_url" type="text" class="mt-1 block w-full" :value="old('original_url')" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('original_url')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
