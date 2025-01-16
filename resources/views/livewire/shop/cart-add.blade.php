<div>
    @livewire('shop.cart-item', ['postId' => $post->id])
    <button class="btn btn-primary" wire:click="addItem()">Buy</button>
    {{-- <button class="btn btn-primary" wire:click="dispatch('addItemToCart', { post: {{ $post }} })">Buy</button> --}}
    {{view('livewire.shop.partials.shop-cart', ['total' => $total]) }}
</div>
