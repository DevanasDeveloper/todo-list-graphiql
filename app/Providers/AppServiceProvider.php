<?php

namespace App\Providers;

use App\Repositories\Interfaces\TodoRepositoryInterface;
use App\Repositories\TodoRepository;
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
        $this->bindingConfig();
    }

    private function bindingConfig(){
        // Bind todo interface to todo repository
        $this->app->bind(
            TodoRepositoryInterface::class,
            TodoRepository::class
        );
    }
}
