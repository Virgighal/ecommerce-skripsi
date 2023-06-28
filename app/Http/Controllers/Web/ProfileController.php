<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Rating;
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
        if(!empty($user) && $user->user_level != 'User') {
            return redirect()->route('admin.home');
        }

        $user = auth()->user();

        $orders = Order::where('user_id', $user->id)->orderBy('id', 'DESC')->get();

        foreach($orders as $order) {
            // get item 
            $orderItems = OrderItem::where('order_id', $order->id)->get();

            foreach($orderItems as $orderItem) {
                $product = Product::where('id', $orderItem->product_id)->first();
                $rating = Rating::where('rateable_id', $orderItem->product_id)->first();

                $ratingStar = 0;
                if(!empty($rating)) {
                    $ratingStar = $rating->rating;
                }
                
                $orderItem->product = $product;
                $orderItem->rating_star = $ratingStar;
            }

            $order->products = $orderItems;
        }

        return view('web.profile', [
            'active_menu' => 'profile',
            'user' => $user,
            'orders' => $orders
        ]);
    }

    public function changeProfile(Request $request)
    {  
        $user = auth()->user();
        if(!empty($user) && $user->user_level != 'User') {
            return redirect()->route('admin.home');
        }

        $user = User::where('id', $user->id)->first();
        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->save();

        return redirect()->route('profile');
    }
}
