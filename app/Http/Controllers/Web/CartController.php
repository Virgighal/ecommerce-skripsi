<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    /**
     * Shows the homepage to the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $products = Product::get();
        $user = auth()->user();

        $cart = Cart::where('user_id', $user->id)->first();
        if (empty($cart)) {
            $cart = new Cart;
            $cart->user_id = $user->id;
            $cart->save();
        }

        $cartItems = CartItem::where('cart_id', $cart->id)->where('checkout', 0)->get();
        $totalPrice = 0;
        foreach($cartItems as $item) 
        {
            $product = Product::where('id', $item->product_id)->first();
            $item->product = $product;
            $totalPrice += $item->price;
        }

        $countCartItemProducts = count($cartItems);

        return view('web.cart', [
            'active_menu' => 'cart',
            'cart_items' => $cartItems,
            'total_products' => $countCartItemProducts,
            'total_price' => $totalPrice
        ]);
    }

    /**
     * Shows the homepage to the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {   
        $user = auth()->user();

        $cart = Cart::where('user_id', $user->id)->first();
        if (empty($cart)) {
            $cart = new Cart;
            $cart->user_id = $user->id;
            $cart->save();
        }

        $product = Product::where('id', $request->product_id)->first();
        
        $checkCartItem = CartItem::where('product_id', $product->id)->where('cart_id', $cart->id)->where('checkout', 0)->first();
        if (empty($checkCartItem)) {
            $cartItem = new CartItem;
            $cartItem->cart_id = $cart->id;
            $cartItem->product_id = $product->id;
            $cartItem->quantity = 1;
            $cartItem->price = $product->price;
            $cartItem->save();
        } else {
            $cartItem = CartItem::where('product_id', $product->id)->where('cart_id', $cart->id)->where('checkout', 0)->first();
            $cartItem->quantity += 1;
            $cartItem->price = $product->price * $cartItem->quantity;
            $cartItem->save();
        }

        $cartItems = CartItem::where('cart_id', $cart->id)->get();
        $totalPrice = 0;
        foreach($cartItems as $item) 
        {
            $product = Product::where('id', $item->product_id)->first();
            $item->product = $product;
            $totalPrice += $item->price;
        }

        $countCartItemProducts = count($cartItems);

        return redirect()->route('cart');
    }
    

    public function checkout(Request $request)
    {
        $user = auth()->user();
        
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItems = CartItem::where('cart_id', $cart->id)->where('checkout', 0)->get();
        if (count($cartItems) == 0) {
            return redirect()->route('cart');
        }

        $totalPrice = 0;
        foreach($cartItems as $item) 
        {
            $product = Product::where('id', $item->product_id)->first();
            $item->product = $product;
            $totalPrice += $item->price;
        }

        return view('web.checkout', [
            'active_menu' => 'cart',
            'total_price' => $totalPrice
        ]);
    }

    public function pay(Request $request)
    {
        $user = auth()->user();
        
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItems = CartItem::where('cart_id', $cart->id)->where('checkout', 0)->get();

        $totalPrice = 0;
        foreach($cartItems as $item) 
        {
            $totalPrice += $item->price;
        }

        $imageFilePath = '';
        $fileName = '';
        if($request->hasFile('image')) {
            $fileName = $request->file('image')->getClientOriginalName();
            $filePath = public_path('image/'.$fileName);

            file_put_contents($filePath, $request->file('image')->getContent());

            $imageFilePath = 'image/'.$fileName;
        }

        $order = new Order;
        $order->user_id = $cart->user_id;
        $order->user_name = $user->name;
        $order->bukti_pembayaran = $imageFilePath;
        $order->total_price = $totalPrice;
        $order->status = 'Menunggu Konfirmasi';
        $order->save();

        foreach($cartItems as $item) 
        {
            $orderItem = new OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->product_id;
            $orderItem->quantity = $item->quantity;
            $orderItem->price = $item->price;
            $orderItem->save();

            $cartItem = CartItem::where('id', $item->id)->first();
            $cartItem->checkout = 1;
            $cartItem->save();
        }

        return redirect()->route('cart');
    }
}
