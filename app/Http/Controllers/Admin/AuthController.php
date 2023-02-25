<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Shows the login page
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handles the user login request
     *
     * @param \Illuminate\Http\Request   $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(auth()->attempt([
            'email' => $request->email, 
            'password' => $request->password
        ])) {
            return redirect()->route('admin.home');
        }

        return back()->with('error_message', 'Invalid login credentials!');
    }

    public function logout()
    {
        return redirect('/admin')->with(Auth::logout());
    }
}
