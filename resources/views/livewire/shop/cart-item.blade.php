<div>
    <div card="box mb-3">
        @if ($item)
            <p>
                <input wire:model='count' wire:keydown.enter='add({{ $item }},$wire.count)' type="number"
                    class="w-20">
                {{ $item->title }}
            </p>
        @endif

    </div>
</div>
