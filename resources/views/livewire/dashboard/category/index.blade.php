<div>


    <div class="container">
        <x-action-message on="deleted">
            <div class="box-action-message">
                {{ __('Category deleted') }}
            </div>

        </x-action-message>

        @slot('header')
            {{ __('CRUD Categories') }}
        @endslot

        <x-card>
            @slot('title')
                Categories
            @endslot
            <a class="btn-secondary mt-3" href="{{ route('d-category-create') }}">+ Create</a>
            <table class="table w-full border">
                <thead class="text-left bg-gray-50">
                    <tr class="border-b">
                        <th class="p-2">Id</th>
                        <th class="p-2">Title</th>
                        <th class="p-2">Text</th>
                        <th class="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="border-b">
                            <td class="p-2">{{ $category->id }}</td>
                            <td class="p-2">{{ $category->title }}</td>
                            <td class="p-2">{{ $category->text }}</td>
                            <td class="p-2">
                                {{-- <button wire:click="edit({{ $category->id }})">Edit</button>
                        <button wire:click="destroy({{ $category->id }})">Delete</button> --}}
                                <a href="{{ route('d-category-edit', $category->id) }}">Edit</a>
                                <x-danger-button
                                    wire:click='selectCategoryToDelete({{ $category }})'>Delete</x-danger-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                {{ $categories->links() }}
                <x-confirmation-modal wire:model="cofirmingDeleteCategory">
                    @slot('title')
                        {{ __('Delete Category') }}
                    @endslot
                    @slot('content')
                        {{ __('Are you sure you want to delete this category?') }}
                    @endslot
                    @slot('footer')
                        <x-secondary-button wire:click="$toggle('cofirmingDeleteCategory')">
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
