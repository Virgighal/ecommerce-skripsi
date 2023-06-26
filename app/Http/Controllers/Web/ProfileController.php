<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Shows the homepage to the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $user = auth()->user();

        $orders = Order::where('user_id', $user->id)->get();

        return view('web.profile', [
            'active_menu' => 'profile',
            'user' => $user,
            'orders' => $orders
        ]);
    }

    public function changeProfile(Request $request)
    {  
        $userLogin = auth()->user();

        $user = User::where('id', $userLogin->id)->first();
        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->save();

        return redirect()->route('profile');
    }
}
