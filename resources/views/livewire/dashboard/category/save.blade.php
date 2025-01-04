<div>
    <div class="container">
        <x-action-message on="created">
            <div class="box-action-message">
                {{ __('Category created') }}
            </div>
        </x-action-message>
        <x-action-message on="updated">
            <div class="box-action-message">
                {{ __('Category updated') }}
            </div>
        </x-action-message>
        <x-form-section submit="submit">
            <x-slot name="title">
                {{ __('Category Information') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Update your category.') }}
            </x-slot>
            @slot('form')
                <div class="col-span-10 sm:col-span-4">
                    @error('title')
                        {{ $message }}
                    @enderror
                    <x-label for="title">Title</x-label>
                    <x-input type="text" wire:model="title" class="w-full" />
                </div>
                <div class="col-span-10 sm:col-span-4">
                    @error('text')
                        {{ $message }}
                    @enderror
                    <x-label for="text">Text</x-label>
                    <x-input type="text" wire:model="text" class="w-full" />
                </div>
                <div class="col-span-10 sm:col-span-4">
                    @error('image')
                        {{ $message }}
                    @enderror
                    <x-label for="text">Image</x-label>
                    <x-input type="file" wire:model="image" class="w-full" />

                    @if ($category && $category->image)
                        <img class="w-40 my-3" src="{{ $category->getImageUrl() }}" alt="{{ $category->title }}">
                    @endif
                </div>
            @endslot
            @slot('actions')
                <x-button type="submit">Guardar</x-button>
            @endslot
        </x-form-section>
    </div>
</div>
