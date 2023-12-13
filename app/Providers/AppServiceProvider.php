<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\Contracts\CommentRepositoryContract;
use App\Repositories\Contracts\IdeaRepositoryContract;
use App\Repositories\Contracts\LikeRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\Eloquent\CommentEloquentRepository;
use App\Repositories\Eloquent\IdeaEloquentRepository;
use App\Repositories\Eloquent\LikeEloquentRepository;
use App\Repositories\Eloquent\UserEloquentRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->bindRepositories();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading(
            !app()->isProduction()
        );
    }

    private function bindRepositories(): void
    {
        $this->app->bind(
            UserRepositoryContract::class,
            UserEloquentRepository::class,
        );

        $this->app->bind(
            CommentRepositoryContract::class,
            CommentEloquentRepository::class,
        );

        $this->app->bind(
            LikeRepositoryContract::class,
            LikeEloquentRepository::class,
        );

        $this->app->bind(
            IdeaRepositoryContract::class,
            IdeaEloquentRepository::class,
        );
    }
}
