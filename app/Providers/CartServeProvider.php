<?php

namespace App\Providers;


use App\Repositories\Cart\CartRepository;
use Illuminate\Support\ServiceProvider;

use App\Repositories\Cart\CartModelRepository;


class CartServeProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CartRepository::class, function () {
            return new CartModelRepository();
        });
    }
    
    
    
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
