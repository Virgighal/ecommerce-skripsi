<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    /**
     * List of products
     *
     * @param Request $request
     * 
     */
    public function index(Request $request)
    {

        if(!auth()->user()->user_level == 'Admin') {
            abort(404);
        }

        $orders = Order::paginate(10);

        return view('admin.orders.index', [
            'orders' => $orders
        ]);
    }

    public function show($id)
    {
        if(!auth()->user()->user_level == 'Admin') {
            abort(404);
        }

        $order = Order::where('id', $id)->first();
        
        if(empty($order)) {
            return redirect()->back()->with('error_message', 'Order is no longer exists!');
        }

        return view('admin.orders.show', [
            'order' => $order
        ]);
    }

    public function update(Request $request, $id)
    {
        if(!auth()->user()->user_level == 'Admin') {
            abort(404);
        }

        $order = Order::where('id', $id)->first();
        
        if(empty($order)) {
            return redirect()->back()->with('error_message', 'Order is no longer exists!');
        }

        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.show', [
            'id' => $order->id
        ])->with('success_message', 'Successfully updated order');
    }

}