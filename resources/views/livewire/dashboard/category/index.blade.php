<div>
    <h1>Categories</h1>
    <a href="{{ route('d-category-create') }}">Create</a>
    <table class="table w-full">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Text</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->title }}</td>
                    <td>{{ $category->text }}</td>
                    <td>
                        {{-- <button wire:click="edit({{ $category->id }})">Edit</button>
                        <button wire:click="destroy({{ $category->id }})">Delete</button> --}}
                        <a href="{{ route('d-category-edit', $category->id) }}">Edit</a>
                        <x-danger-button onclick="confirm('Seguro quieres eliminar?') || event.stopImmediatePropagation()" wire:click='delete({{ $category}})'>Delete</x-danger-button>
                    </td>
                </tr>
            @endforeach
        </tbody>
        {{ $categories->links() }}
    </table>
</div>
