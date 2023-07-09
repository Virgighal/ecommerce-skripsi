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

        if($request->hasFile('image')) {
            $oldImageFilePath = public_path($order->image_file_path);
            unlink($oldImageFilePath);

            $fileName = $request->file('image')->getClientOriginalName();
            $filePath = public_path('order-image/'.$fileName);

            file_put_contents($filePath, $request->file('image')->getContent());

            $imageFilePath = 'order-image/'.$fileName;
        }

        $order->status = $request->status;
        if(!empty($imageFilePath)) {
            $order->image_file_path = $imageFilePath;
        }
        $order->save();

        return redirect()->route('admin.orders.show', [
            'id' => $order->id
        ])->with('success_message', 'Successfully updated order');
    }

}