<div>
    <div class="container">
        <x-action-message on="deleted">
            <div class="box-action-message">
                {{ __('Post deleted') }}
            </div>

        </x-action-message>

        @slot('header')
            {{ __('CRUD Post') }}
        @endslot

        <x-card>
            @slot('title')
                Post
            @endslot
            <a class="btn-secondary mt-3" href="{{ route('d-post-create') }}">+ Create</a>
            <br>
            <div class="grid grid-cols-2 mb-3">
                <select class="block w-full" wire:model.live='posted'>
                    <option value=''>{{ __('Posted') }}</option>
                    <option value='yes'>{{ __('Yes') }}</option>
                    <option value='not'>{{ __('Not') }}</option>
                </select>
                <select class="block w-full" wire:model.live='type'>
                    <option value=''>{{ __('Type') }}</option>
                    <option value='advert'>{{ __('Advert') }}</option>
                    <option value='post'>{{ __('Post') }}</option>
                    <option value='course'>{{ __('Course') }}</option>
                    <option value='page'>{{ __('Page') }}</option>
                </select>
                <select class="block w-full" wire:model.live='category_id'>
                    <option value=''>{{ __('Category') }}</option>
                    @foreach ($categories as $c)
                        <option value='{{ $c->id }}'>{{ $c->title }}</option>
                    @endforeach
                </select>
                <x-input wire:model.live='search' placeholder="{{__('Search...')}}"></x-input>
                <div class="grid grid-cols-2 gap-2">
                    <x-input class="w-full" type="date" wire:model='from' placeholder="Desde"></x-input>
                    <x-input class="w-full" type="date" wire:model.live='to' placeholder="Hasta"></x-input>
                </div>
            </div>
            <table class="table w-full border">
                <thead class="text-left bg-gray-50">
                    <tr class="border-b">
                        <th class="p-2">Id</th>
                        <th class="p-2">Title</th>
                        <th class="p-2">Description</th>
                        <th class="p-2">Category</th>
                        <th class="p-2">Date</th>
                        <th class="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr class="border-b">
                            <td class="p-2">{{ $post->id }}</td>
                            <td class="p-2">{{ str($post->title)->substr(0, 15) }}</td>
                            <td class="p-2">
                                <textarea> {{ $post->description }}</textarea>
                            </td>
                            <td class="p-2">{{ $post->category->title }}</td>
                            <td class="p-2">{{ $post->date }}</td>
                            <td class="p-2">
                                {{-- <button wire:click="edit({{ $post->id }})">Edit</button>
                        <button wire:click="destroy({{ $post->id }})">Delete</button> --}}
                                <a href="{{ route('d-post-edit', $post->id) }}">Edit</a>
                                <x-danger-button
                                    wire:click='selectPostToDelete({{ $post }})'>Delete</x-danger-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <x-confirmation-modal wire:model="cofirmingDeletePost">
                    @slot('title')
                        {{ __('Delete Post') }}
                    @endslot
                    @slot('content')
                        {{ __('Are you sure you want to delete this post?') }}
                    @endslot
                    @slot('footer')
                        <x-secondary-button wire:click="$toggle('cofirmingDeletePost')">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                        <x-danger-button wire:click="delete()" class="ml-3">
                            {{ __('Delete') }}
                        </x-danger-button>
                    @endslot
                </x-confirmation-modal>
            </table>
            {{ $posts->links() }}
        </x-card>
    </div>
</div>
