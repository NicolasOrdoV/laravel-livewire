<div>
    <div class="container">
        <x-action-message on="created">
            <div class="box-action-message">
                {{ __('Post created') }}
            </div>
        </x-action-message>
        <x-action-message on="updated">
            <div class="box-action-message">
                {{ __('Post updated') }}
            </div>
        </x-action-message>
        <x-form-section submit="submit">
            <x-slot name="title">
                {{ __('Post Information') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Update your post.') }}
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
                    @error('date')
                        {{ $message }}
                    @enderror
                    <x-label for="date">Date</x-label>
                    <x-input type="date" wire:model="date" class="w-full" />
                </div>
                <div class="col-span-10 sm:col-span-4">
                    @error('text')
                        {{ $message }}
                    @enderror
                    <x-label for="text">Text</x-label>
                    <textarea wire:model="text" class="w-full"></textarea>
                </div>
                <div class="col-span-10 sm:col-span-4">
                    @error('description')
                        {{ $message }}
                    @enderror
                    <x-label for="description">Description</x-label>
                    <textarea wire:model="description" class="w-full"></textarea>

                </div>
                <div class="col-span-10 sm:col-span-4">
                    @error('posted')
                        {{ $message }}
                    @enderror
                    <x-label for="posted">Posted</x-label>
                    <select wire:model="posted" class="block w-full">
                        <option></option>
                        <option value="yes">Yes</option>
                        <option value="not">No</option>
                    </select>

                </div>
                <div class="col-span-10 sm:col-span-4">
                    @error('type')
                        {{ $message }}
                    @enderror
                    <x-label for="type">Type</x-label>
                    <select wire:model="type" class="block w-full">
                        <option></option>
                        <option value="advert">Advert</option>
                        <option value="post">Post</option>
                        <option value="course">Course</option>
                        <option value="movie">Movie</option>
                    </select>

                </div>
                <div class="col-span-10 sm:col-span-4">
                    @error('category_id')
                        {{ $message }}
                    @enderror
                    <x-label for="category_id">Category</x-label>
                    <select wire:model="category_id" class="block w-full">
                        <option></option>
                        @foreach ($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->title }}</option>
                        @endforeach

                    </select>

                </div>



                <div class="col-span-10 sm:col-span-4">
                    @error('image')
                        {{ $message }}
                    @enderror
                    <x-label for="text">Image</x-label>
                    <x-input type="file" wire:model="image" class="w-full" />

                    @if ($post && $post->image)
                        <img class="w-40 my-3" src="{{ $post->getImageUrl() }}" alt="{{ $post->title }}">
                    @endif
                </div>
            @endslot
            @slot('actions')
                <x-button type="submit">Guardar</x-button>
            @endslot
        </x-form-section>
    </div>
</div>
