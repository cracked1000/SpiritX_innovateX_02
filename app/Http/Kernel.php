<?php
class Kernel {
    protected $routeMiddleware = [
        // Other middleware...
        'admin' => \App\Http\Middleware\AdminCheck::class,
    ];
}