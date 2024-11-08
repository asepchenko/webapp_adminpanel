<?php

namespace App\Http\Middleware;

use Closure;
//use GuzzleHelper;
//use GuzzleHttp\Exception\GuzzleException;
use phpDocumentor\Reflection\Types\Void_;

class CustomAuthentication
{
    public function handle($request, Closure $next)
    {
        //$token = $request->input('app_token');
        $token = $request->session()->get('app_token');
        if ($token !== null) {
            //$request->session()->put('authenticated', true);
            //$request->session()->put('app_token', $token);
            return $next($request);
        }

        //$request->session()->forget('app_token');
        //$request->session()->forget('authenticated');
        return redirect()->route('login');
    }
}
