<?php

namespace App\Http\Controllers;

//use Session;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /*public $permission;
    public function __construct()
    {
        
        $this->middleware(function ($request, $next){
            $this->permission = Session::get('permission');
    
    
            return $next($request);
        });
    }*/
}
