<?php

namespace App\Providers;

use App\Contracts\AnswerServiceInterface;
use App\Contracts\QuestionServiceInterface;
use App\Contracts\ReputationServiceInterface;
use App\Services\AnswerService;
use App\Services\QuestionService;
use App\Services\ReputationService;
use Illuminate\Support\Facades\Policy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            ReputationServiceInterface::class,
            ReputationService::class
        );

        $this->app->bind(
            QuestionServiceInterface::class,
            QuestionService::class
        );

        $this->app->bind(
            AnswerServiceInterface::class,
            AnswerService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $this->registerPolicies();
    }

    protected function registerPolicies(): void
    {
        Policy::for(Answer::class, AnswerPolicy::class);
    }
}
