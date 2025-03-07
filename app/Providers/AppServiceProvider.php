<?php

namespace App\Providers;

use App\Models\ShoppingCart;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Event::listen(function(Login $event) {
        //     $this->setShoppingCartSession();
        // });
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
