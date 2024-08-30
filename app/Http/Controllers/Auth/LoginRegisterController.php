<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;
// use Illuminate\Routing\Controllers\HasMiddleware;
// use Illuminate\Routing\Controllers\Middleware;


class LoginRegisterController extends Controller
{
  
    // public static function middleware(): array
    // {
    //     return [
    //         //new Middleware('guest', except: ['home', 'logout']),
    //         new Middleware('auth', only: ['home', 'logout']),
    //     ];
    // }
  
    /**
     * Load a login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(): View
    {
        return view('auth.login');
    }

    /**
     * Submit login user form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
          // dd('here');
            $request->session()->regenerate();
            return redirect()->route('home')->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'name' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('name');

    } 

    /**
     * Home page
     * 
     */
    public function home(): View
    {
       // dd(Auth::user('name'));
        return view('home');
    } 


    /**
     * Logout
     */

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->withSuccess('You have logged out successfully!');
    }
}
