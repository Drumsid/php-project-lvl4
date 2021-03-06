<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        \Form::component('bsText', 'components.form.text', ['name', 'value', 'attributes']);
        \Form::component('bsTextarea', 'components.form.textarea', ['name', 'value', 'attributes']);
        \Form::component('bsSelect', 'components.form.select', ['name', 'label', 'list' => [], 'selected' => null, 'attributes' => []]);
    }
}
