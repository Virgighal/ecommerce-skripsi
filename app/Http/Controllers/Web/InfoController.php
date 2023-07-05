<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    /**
     * 
     */
    public function index()
    {
        if(!empty(auth()->user()) && auth()->user()->user_level != 'User') {
            return redirect()->route('admin.home');
        }

        return view('web.info', [
            'active_menu' => 'info'
        ]);
    }
}
