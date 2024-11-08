<?php

namespace App\Http\Middleware;

//use App\Models\Role;
use Session, Closure;
use Illuminate\Support\Facades\Gate;

class AuthGates
{
    public function handle($request, Closure $next)
    {
        $user = Session::get('user'); //\Auth::user();
        if (!app()->runningInConsole() && $user) {
            $permission            = Session::get('permission'); //Role::with('permissions')->get();
            /*$permissionsArray = [];

            foreach ($roles as $permissions) {
                //foreach ($role->permissions as $permissions) {
                    $permissionsArray[$permissions->title][] = $role->id;
               // }
            }*/

            foreach ($permission as $p) {
                /*Gate::define($title, function (\App\Models\User $user) use ($roles) {
                    return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
                });*/
                //Gate::define($p->title, function($user) use ($permission){
                    //return count(array_intersect($p->title, $permission)) > 0;
                Gate::define($p->title, function($user = null){
                    return true; //in_array($title, $roles);
                });
            }
        }

        return $next($request);
    }
}
