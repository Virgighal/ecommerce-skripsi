<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

        $notifications = Notification::where('user_level', 'User')
            ->where('user_id', $user->id)
            ->where('is_read', 0)
            ->get();

        return view('web.profile', [
            'active_menu' => 'profile',
            'active_page' => 'profile',
            'user' => $user,
            'orders' => $orders,
            'notifications' => $notifications
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
        $user->address = $request->address;
        $user->save();

        return redirect()->route('profile')->with('success_message', 'Berhasil mengubah profile')
            ->with('active_page', 'profile');
    }

    public function confirmOrder(Request $request, $id)
    {
        if(auth()->user()->user_level != 'User') {
            return redirect()->route('admin.home');
        }

        $order = Order::where('id', $id)->first();
        
        if(empty($order)) {
            return redirect()->back()->with('error_message', 'Order is no longer exists!');
        }

        DB::transaction(function() use($order) {
            $order->status = "Pesanan Diterima";
            $order->save();

            $adminUsers = User::where('user_level', 'Admin')->get();

            foreach($adminUsers as $adminUser) {
                Notification::where('user_level', 'Admin')->create([
                    'transaction_id' => $order->id,
                    'transaction_number' => $order->transaction_number,
                    'user_id' => $adminUser->id,
                    'customer_name' => $order->user_name,
                    'user_level' => $adminUser->user_level,
                    'status' => $order->status,
                    'is_read' => 0
                ]);
            }
        }, 5);

        return redirect()->route('profile')->with('success_message', 'Berhasil konfirmasi penerimaan pesanan')
            ->with('active_page', 'order_history');
    }

    public function updateNotificationStatus(Request $request)
    {
        $user_id = $request->user_id;
        Notification::where('user_id', $user_id)->update(['is_read' => 1]);

        return response()->json(['message' => 'Notification status updated successfully']);
    }
}
