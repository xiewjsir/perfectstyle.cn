<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\AdminNode;
use App\Observers\AdminNodeObserver;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        AdminNode::observe(AdminNodeObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
