<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;

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
        if(auth()->user()->user_level != 'Admin') {
            return redirect()->route('home');
        }

        $orders = Order::orderBy('id', 'DESC')->paginate(10);

        return view('admin.orders.index', [
            'orders' => $orders
        ]);
    }

    public function show($id)
    {
        if(auth()->user()->user_level != 'Admin') {
            return redirect()->route('home');
        }

        $order = Order::where('id', $id)->first();
        
        if(empty($order)) {
            return redirect()->back()->with('error_message', 'Order is no longer exists!');
        }

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
        
        $order->items = $orderItems;

        Notification::where('transaction_id', $order->id)
            ->where('user_id', auth()->user()->id)
            ->update([
                'is_read' => 1
            ]);

        return view('admin.orders.show', [
            'order' => $order
        ]);
    }

    public function update(Request $request, $id)
    {
        if(auth()->user()->user_level != 'Admin') {
            return redirect()->route('home');
        }

        $order = Order::where('id', $id)->first();
        
        if(empty($order)) {
            return redirect()->back()->with('error_message', 'Order is no longer exists!');
        }

        if($request->status == 'Selesai Pengiriman') {
            request()->validate([
                'image' => 'required',
            ],
            [
                'image.required' => 'Silahkan upload bukti jika pesanan sudah diselesaikan',
            ]);
        }

        $imageFilePath = NULL;
        if($request->hasFile('image')) {
            $oldImageFilePath = public_path($order->image_file_path);
            unlink($oldImageFilePath);

            $fileName = $request->file('image')->getClientOriginalName();
            $filePath = public_path('order-image/'.$fileName);

            file_put_contents($filePath, $request->file('image')->getContent());

            $imageFilePath = 'order-image/'.$fileName;
        }

        DB::transaction(function() use($request, $imageFilePath, $order) {
            $order->status = $request->status;
            if(!empty($imageFilePath)) {
                $order->image_file_path = $imageFilePath;
            }
            $order->save();
    
            Notification::where('user_id', $order->user_id)->create([
                'transaction_id' => $order->id,
                'transaction_number' => $order->transaction_number,
                'user_id' => $order->user_id,
                'customer_name' => $order->user_name,
                'user_level' => 'User',
                'status' => $order->status,
                'is_read' => 0
            ]);
        }, 5);

        return redirect()->route('admin.orders.show', [
            'id' => $order->id
        ])->with('success_message', 'Successfully updated order');
    }

    /**
     * print struk
     *
     * @param [type] $id
     * @return void
     */
    public function print($id)
    {
        if(auth()->user()->user_level != 'Admin') {
            return redirect()->route('home');
        }

        $order = Order::where('id', $id)->first();
        
        if(empty($order)) {
            return redirect()->back()->with('error_message', 'Order is no longer exists!');
        }

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
        
        $order->items = $orderItems;

        return view('admin.orders.print', [
            'order' => $order
        ]);
    }

}