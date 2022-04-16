<?php

namespace App\Providers;

use App\Contracts\Repositories\BaseRepositoryContract;
use App\Contracts\Repositories\PromotionRepositoryContract;
use App\Contracts\Repositories\UserRepositoryContract;
use App\Repositories\BaseRepository;
use App\Repositories\PromotionRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseRepositoryContract::class, BaseRepository::class);
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
