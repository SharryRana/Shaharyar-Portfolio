<?php

namespace Modules\BlogAdmin\Http\Middleware;

use Closure;

class InertiaRootSwitch
{
    public function handle($request, Closure $next)
    {
        \Inertia\Inertia::setRootView('blogadmin::app');

        return $next($request);
    }
}
