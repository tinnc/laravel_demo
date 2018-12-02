<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Policies\PostPolicy;
use App\Models\News;
use App\Models\Product;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        News::class => PostPolicy::class,
        Product::class => ProductPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //compare id of models
        // Gate::define('news.update', function ($user, $article) {
        //     return $user->id == $article->user_id;
        // });
        //
        // Gate::define('news.update', 'PostPolicy@update');

    }
}
