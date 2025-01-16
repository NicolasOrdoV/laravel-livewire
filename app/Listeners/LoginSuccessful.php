<?php

namespace App\Listeners;

use App\Models\ShoppingCart;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class LoginSuccessful
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $this->setShoppingCartSession();
    }

    private function setShoppingCartSession(): void
    {
        $cartDb = ShoppingCart::where('user_id', Auth::id())->get();
        $cartSession = session('cart', []);
        foreach($cartDb as $cart) {
            if(Arr::exists($cartSession, $cart->post->id)) {
                $cartSession[$cart->post->id][1] = $cart->count;
            } else {
                $cartSession[$cart->post->id] = [$cart->post, $cart->count];
            }
        }

        session(['cart' => $cartSession]);
    }
}
