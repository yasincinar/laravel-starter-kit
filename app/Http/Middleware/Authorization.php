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
        $method = $request->method();
        $requestRouteName = explode('.', $request->route()->getName());
        $hasAccess = false;
        switch ($method) {
            case 'GET':
                $permission = array_pop($requestRouteName);
                $permissionGroup = array_pop($requestRouteName);
                $hasAccess = Sentinel::hasAccess($permissionGroup . "." . $permission);
                break;
            case 'POST':
                $permission = array_pop($requestRouteName);
                $permissionGroup = array_pop($requestRouteName);
                $permission = ($permission == 'store' ? 'create' : $permission);
                $hasAccess = Sentinel::hasAnyAccess($permissionGroup . "." . $permission);
                break;
            case 'DELETE':
                $permission = array_pop($requestRouteName);
                $permissionGroup = array_pop($requestRouteName);
                $permission = ($permission == 'store' ? 'create' : $permission);
                $hasAccess = Sentinel::hasAnyAccess($permissionGroup . "." . $permission);
                break;
            case 'PUT':
                break;
        }

        if ($hasAccess) {
            return $next($request);
        } else {
            abort(403, "Yetki Yok");
        }

    }
}
