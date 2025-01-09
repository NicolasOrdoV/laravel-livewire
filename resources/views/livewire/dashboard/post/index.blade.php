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
            <table class="table w-full border">
                <thead class="text-left bg-gray-50">
                    <tr class="border-b">
                        <th class="p-2">Id</th>
                        <th class="p-2">Title</th>
                        <th class="p-2">Text</th>
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
                            <td class="p-2">{{ $post->title }}</td>
                            <td class="p-2">{{ $post->text }}</td>
                            <td class="p-2">{{ $post->description }}</td>
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
                {{ $posts->links() }}
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
        </x-card>
    </div>
</div>
