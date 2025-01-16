<?php

namespace App\Livewire\Shop;

use App\Models\Post;
use App\Models\ShoppingCart;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartItem extends Component
{
    public $count;

    public $item;

    protected $listeners = ['addItemToCard' => 'add'];

    function mount($postId)
    {
        $cart = session('cart', []);

        if (Arr::exists($cart, $postId)) {

            $this->item = $cart[$postId][0];
            $this->count = $cart[$postId][1];
        }

        // $post1 = Post::find(4);
        // $post2 = Post::find(5);
        // $post3 = Post::find(6);

        // session('cart', [$post1, $post2, $post3]);
    }
    public function render()
    {
        return view('livewire.shop.cart-item');
    }

    private function saveDB($cart)
    {
        if(Auth::check()){
            $control = time();
            foreach($cart as $c) {
                ShoppingCart::updateOrCreate([
                    'post_id' => $c[0]->id,
                    'user_id' => Auth::id(),
                ], [
                    'count' => $c[1],
                    'control' => $control,
                    'post_id' => $c[0]->id,
                    'user_id' => Auth::id(),
                ]);

                ShoppingCart::whereNot('control', $control)->where('user_id', Auth::id())->delete();
            }
        }
    }

    function addItem()
    {
        $this->dispatch('addItemToCard', $this->post);
    }

    function add(Post $post, int $count = 1)
    {
        $cart = session('cart', []);
        //delete
        if ($count <= 0) {
            if (Arr::exists($cart, $post->id)) {
                unset($cart[$post->id]);
                unset($this->item);
                unset($this->count);
                session(['cart' => $cart]);
                $this->saveDB($cart);
                $this->dispatch('itemDelete');
            }

            return;
        }

        //add- insert
        if (Arr::exists($cart, $post->id)) {
            $cart[$post->id][1] = $count;
            $this->dispatch('itemChange', $post);
        } else {
            $cart[$post->id] = [$post, $count];
            $this->dispatch('itemAdd', $post);
        }

        //dd($cart);

        $this->item = $post;
        $this->count = $count;

        session(['cart' => $cart]);
        $this->saveDB($cart);
    }


}
