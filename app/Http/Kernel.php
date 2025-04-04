<?php

namespace App\Http;

class Kernel
{
    protected $routeMiddleware = [
        // ... other middleware
        'role' => \App\Http\Middleware\EnsureUserHasRole::class,
    ];
}