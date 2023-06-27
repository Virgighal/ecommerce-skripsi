<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

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
     * Shows the login page
     *
     * @return \Illuminate\Http\Response
     */
    public function showUserLoginForm()
    {
        return view('auth.user-login');
    }

    /**
     * Shows the register page
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Handles the user login request
     *
     * @param \Illuminate\Http\Request   $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'phone_number' => 'required',
        ]);

        $checkUser = User::where('email', $request->email)->first();
        if (!empty($checkUser)) {
            return back()->with('error_message', 'This email already have account!');
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone_number = $request->phone_number;
        $user->user_level = 'User';
        $user->save();

        return redirect()->route('show-login');
    }

    /**
     * Handles the user login request
     *
     * @param \Illuminate\Http\Request   $request
     * @return \Illuminate\Http\Response
     */
    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $successLogin = false;
        if(auth()->attempt([
            'email' => $request->email, 
            'password' => $request->password
        ])) {
            $user = auth()->user();
            if ($user->user_level == 'Admin') {
                $successLogin = true;
            }
        }

        if($successLogin) {
            Token::create([
                'user_id' => $user->id,
                'token' => Str::random(191)
            ]);
            return redirect()->route('admin.home');
        } else {
            return back()
                ->with(Auth::logout())
                ->with('error_message', 'Sorry, you cannot access this page');
        }
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

        $successLogin = false;
        if(auth()->attempt([
            'email' => $request->email, 
            'password' => $request->password
        ])) {
            $user = auth()->user();
            if ($user->user_level == 'User') {
                $successLogin = true;
            }
        }

        if($successLogin) {
            Token::create([
                'user_id' => $user->id,
                'token' => Str::random(191)
            ]);
            return redirect()->route('menu');
        } else {
            return back()
                ->with(Auth::logout())
                ->with('error_message', 'Sorry, you cannot access this page');
        }

    }

    public function logout()
    {        
        return redirect('/')->with(Auth::logout());
    }

    public function adminLogout()
    {        
        return redirect('/')->with(Auth::logout());
    }
}
