<?php

namespace Dedoc\Scramble\Http\Middleware;

use Illuminate\Support\Facades\Gate;

class RestrictedDocsAccess
{

    public function handle($request, \Closure $next)
    {
        if (app()->environment('local') || app()->environment('production') || app()->environment('staging') ) {
            return $next($request);
        }
        if (Gate::allows('viewApiDocs')) {
            return $next($request);
        }

        abort(403);
    }
}
