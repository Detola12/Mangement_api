<?php

namespace App\Providers;

use App\Events\MadePayment;
use App\Interfaces\Productable;
use App\Listeners\UpdateOrder;
use App\Services\ProductService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use L5Swagger\L5SwaggerServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(Productable::class, ProductService::class);
        $this->app->register(L5SwaggerServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
