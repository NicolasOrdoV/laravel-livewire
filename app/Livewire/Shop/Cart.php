<?php

namespace App\Livewire\Shop;

use App\Models\Post;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Cart extends Component
{

    public $type = 'list';

    public $post;

    public $cart;

    public $total;

    protected $listeners = ['itemDelete' => 'total', 'itemAdd' => 'total', 'itemChange' => 'total'];


    function initSessionCart(Post $post, $type = 'list')
    {
        $this->cart =  session('cart', []);
        $this->type = $type;
        $this->post = $post;
        //$session = new Session();
        // $cart = $session->get('cart', []);
        // $post1 = Post::find(4);
        // $post2 = Post::find(5);
        // $post3 = Post::find(6);

        // session('cart', [$post1, $post2, $post3]);
    }

    public function mount(Post $post, $type = 'list')
    {
        //$this->initSessionCart();
        $this->type = $type;
        $this->post = $post;
        $this->cart = session('cart', []);
    }

    function addItem()
    {
        $this->dispatch('addItemToCard', $this->post);
    }

    public function getTotal()
    {
        if (Auth::check()) {
            $this->total = ShoppingCart::where('user_id', Auth::id())->sum('count');
        }

    }

    public function render()
    {
        if ($this->type == 'list') {
            return view('livewire.shop.cart');
        }
        return view('livewire.shop.cart-add');
    }
}
