<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
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
        if(auth()->user()->user_level != 'Admin') {
            return redirect()->route('home');
        }

        $comments = Comment::orderBy('id', 'DESC')->groupBy('order_id')->paginate(25);

        return view('admin.home')
            ->with('comments', $comments);
    }
}
