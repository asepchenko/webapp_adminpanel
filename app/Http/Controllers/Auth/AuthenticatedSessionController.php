<?php

namespace App\Http\Controllers\Auth;

//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    //use AuthenticatesUsers;
    //Display the login view
    public function create(Request $request)
    {
        //if user still logged in, redirect to dashboard
        $token = $request->session()->get('app_token');
        if ($token != null) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    //Handle an incoming authentication request
    public function store(LoginRequest $request)
    {
        $url = config('api.api_url')."/login";
        $response = Http::post($url, [
            'nik' => $request->nik,
            'password' => $request->password,
        ]);
        $responseBody = json_decode($response->getBody());

        if($responseBody->message == "ok"){
            $token = $responseBody->access_token;
            $user = $responseBody->data;
            $permission = $responseBody->permission;
            //$request->authenticate();
            //$this->credentials($request->all());
            $request->session()->regenerate();
            $request->session()->put('authenticated', true);
            $request->session()->put('user', $user);
            $request->session()->put('permission', $permission);
            $request->session()->put('app_token', $token);
            //Auth::login($user, false);
            //$temp = Auth::user();
            //dd(Auth::user());
            return response(['message' => 'OK'], 200);
            //return redirect()->route('dashboard'); //intended(RouteServiceProvider::HOME);
        }else{
            return response(['message' => $responseBody->data], 400);
            //return redirect()->route('login');
        }
        //$request->authenticate();

        //$request->session()->regenerate();

        
    }

    public function credentials(Request $request)
    {
        return [
            'email'     => $request->email,
            'password'  => $request->password,
            'is_active' => '1'
        ];
    }
    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        //$url= config('api.api_url')."/logout";
        //$response = Http::post($url);

        $request->session()->forget('authenticated');
        $request->session()->forget('user');
        $request->session()->forget('permission');
        $request->session()->forget('app_token');
        $request->session()->flush();
        $request->session()->save();
        
        return redirect('/');

        //Auth::guard('custom_auth')->logout();
        
        //$request->session()->invalidate();
        
        //dd($request->session()->get('app_token'));
        //$request->session()->regenerateToken();
    }
}
