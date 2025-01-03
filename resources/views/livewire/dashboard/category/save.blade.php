<div>
    <x-action-message on="created">
        {{ __('Category created') }}
    </x-action-message>
    <x-action-message on="updated">
        {{ __('Category updated') }}
    </x-action-message>
    <x-action-message on="deleted">
        {{ __('Category deleted') }}
    </x-action-message>
    <form wire:submit.prevent="submit">
        @error('title')
            {{ $message }}
        @enderror
        <div>
            <label for="title">title</label>
            <input type="text" wire:model="title">
        </div>

        @error('text')
            {{ $message }}
        @enderror
        <div>
            <label for="text">Text</label>
            <input type="text" wire:model="text">

            {{-- <input type="text" wire:model="text" wire:keydown.enter="submit"> --}}
        </div>
        @error('image')
            {{ $message }}
        @enderror
        <div>
            <label for="text">image</label>
            <input type="file" wire:model="image">

            @if ($category && $category->image)
                <img class="w-40 my-3" src="{{ $category->getImageUrl() }}" alt="{{ $category->title }}">
            @endif
        </div>
        <button type="submit">Guardar</button>
    </form>
</div>
