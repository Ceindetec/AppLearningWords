<?php

namespace LearningWords\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \LearningWords\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \LearningWords\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \LearningWords\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \LearningWords\Http\Middleware\RedirectIfAuthenticated::class,
        'is_super' => \LearningWords\Http\Middleware\IsSuperAdmin::class,
        'is_admin' => \LearningWords\Http\Middleware\IsAdmin::class,
        'is_docente' => \LearningWords\Http\Middleware\IsDocente::class,
        'is_estudiante' => \LearningWords\Http\Middleware\IsEstudiante::class
    ];
}
