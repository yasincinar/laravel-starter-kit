<?php

namespace App\Http\Middleware;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;

class Authorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
         | This middleware create for check authorization of request in the admin panel.
         |
         | @param $permission is the route name's last word.
         | @param $permissionGroup is the route name's penultimate word
         |  Both variable use for sentinel has access
         |
         |
         |
         */

        $requestUri = array_values(array_filter(explode('/', $request->getRequestUri())));

        if ($requestUri[0] == 'admin' && $requestUri[1] == 'ajax') {
            if (Sentinel::hasAccess('admin.dashboard')) {
                return $next($request);
            } else {
                abort(403, trans('access_denied'));
            }
        } else {
            $method = $request->method();

            $requestRouteName = explode('.', $request->route()->getName());

            $permission = array_pop($requestRouteName);
            $permissionGroup = array_pop($requestRouteName);

            switch ($method) {
                case 'GET':
                    $permission = ($permission == 'index' ? 'show' : $permission);
                    break;
                case 'POST':
                    $permission = ($permission == 'store' ? 'create' : $permission);
                    break;
                case 'DELETE':
                    $permission = ($permission == 'destroy' ? 'delete' : $permission);
                    break;
                case 'PUT':
                    $permission = ($permission == 'update' ? 'edit' : $permission);
                    break;
            }

            $hasAccess = Sentinel::hasAccess($permissionGroup . "." . $permission);

            if ($hasAccess) {
                return $next($request);
            } else {
                abort(403, trans('access_denied'));
            }
        }

    }
}
