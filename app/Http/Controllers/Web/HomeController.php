<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Shows the homepage to the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        if(!empty(auth()->user()) && auth()->user()->user_level != 'User') {
            return redirect()->route('admin.home');
        }

        return view('web.home', [
            'active_menu' => 'home'
        ]);
    }
}
