<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    // Function for directing to login page
    public function login(){
        if(View::exists('login')){
            // return view('user.create');
            return view('login');
        } else {
            return abort(404);
            // this works, keep it.
            // return response()->view('errors.404');
        }
    }
    
    // Function for login of user or admin
    public function process(Request $request){
        $validated = $request->validate([
            "email" => ['required', 'email'],
            'password' => 'required'
        ]);
        if(auth()->attempt($validated)){
            // if valid, reregenerate tayo ng Token
            $request->session()->regenerateToken();
            // then redirect tayo sa home with message
            // return redirect('/')->with('message', 'Welcome back!');
            if(auth()->user()->position != 'User'){
                return redirect('/admin/home')->with('message', 'Welcome back!');
            } else {
                return redirect('/admin/inventory-list')->with('message', 'Welcome back!');
            }
        }
        // pag ok sya, lets authentication attempt for validation given credentials
        return back()->withErrors(['email' => 'Login failed'])->onlyInput('email');
        return back()->withErrors(['password' => 'Login failed'])->onlyInput('password');
    }

    // Function for logging out
    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('message','Logout Successfully');
    }    
}
