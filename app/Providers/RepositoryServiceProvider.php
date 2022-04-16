<?php

namespace App\Providers;

use App\Contracts\Repositories\TeamRepositoryContract;
use App\Contracts\Repositories\UserRepositoryContract;
use App\Repositories\TeamRepository;
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
       $this->bindRepositories();
    }

    /**
     * bind Repositories.
     *
     * @return void
     */
    private function bindRepositories()
    {
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(TeamRepositoryContract::class, TeamRepository::class);
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
