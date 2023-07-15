<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Location;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\RadiusCheckerService;

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
        if(!empty(auth()->user()) && auth()->user()->user_level != 'User') {
            return redirect()->route('admin.home');
        }

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
        if(!empty($user) && $user->user_level != 'User') {
            return redirect()->route('admin.home');
        }

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

    /**
     * Shows the homepage to the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deduct(Request $request)
    {   
        $user = auth()->user();
        if(!empty($user) && $user->user_level != 'User') {
            return redirect()->route('admin.home');
        }

        $cart = Cart::where('user_id', $user->id)->first();
        if (empty($cart)) {
            $cart = new Cart;
            $cart->user_id = $user->id;
            $cart->save();
        }

        $product = Product::where('id', $request->product_id)->first();
        
        $checkCartItem = CartItem::where('product_id', $product->id)->where('cart_id', $cart->id)->where('checkout', 0)->first();
        if(!empty($checkCartItem)) {
            $cartItem = CartItem::where('product_id', $product->id)->where('cart_id', $cart->id)->where('checkout', 0)->first();

            if($cartItem->quantity == 1) {
                $cartItem->delete();
            } else {
                $cartItem->quantity -= 1;
                $cartItem->price = $product->price * $cartItem->quantity;
                $cartItem->save();
            }
        } 

        $cartItems = CartItem::where('cart_id', $cart->id)->get();
        $totalPrice = 0;

        if(count($cartItems) > 0) {
            foreach($cartItems as $item) 
            {
                $product = Product::where('id', $item->product_id)->first();
                $item->product = $product;
                $totalPrice += $item->price;
            }
        } else {
            $cart->delete();
        }

        return redirect()->back();
    }

    /**
     * Shows the homepage to the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {   
        $user = auth()->user();
        if(!empty($user) && $user->user_level != 'User') {
            return redirect()->route('admin.home');
        }

        $cart = Cart::where('user_id', $user->id)->first();
        if (empty($cart)) {
            $cart = new Cart;
            $cart->user_id = $user->id;
            $cart->save();
        }

        $product = Product::where('id', $request->product_id)->first();
        
        $checkCartItem = CartItem::where('product_id', $product->id)->where('cart_id', $cart->id)->where('checkout', 0)->first();
        if(!empty($checkCartItem)) {
            $cartItem = CartItem::where('product_id', $product->id)->where('cart_id', $cart->id)->where('checkout', 0)->first();

            $cartItem->delete();
        } 

        $cartItems = CartItem::where('cart_id', $cart->id)->get();
        $totalPrice = 0;

        if(count($cartItems) > 0) {
            foreach($cartItems as $item) 
            {
                $product = Product::where('id', $item->product_id)->first();
                $item->product = $product;
                $totalPrice += $item->price;
            }
        } else {
            $cart->delete();
        }

        return redirect()->back();
    }
    

    public function checkout(Request $request)
    {
        $user = auth()->user();
        if(!empty($user) && $user->user_level != 'User') {
            return redirect()->route('admin.home');
        }
        
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItems = CartItem::where('cart_id', $cart->id)->where('checkout', 0)->get();
        if (count($cartItems) == 0) {
            return redirect()->route('cart');
        }

        foreach($cartItems as $item) {
            $product = Product::where('id', $item->product_id)->first();
            if(empty($product)) {
                return redirect()->back()->with('error_message', 'Product tidak dapat ditemukan');
            }

            if($item->quantity > $product->stock) {
                return redirect()->back()->with('error_message', 'Jumlah yang di order melebihi total stock yang tersedia!');
            }
        }

        $totalPrice = 0;
        foreach($cartItems as $item) 
        {
            $product = Product::where('id', $item->product_id)->first();
            $item->product = $product;
            $totalPrice += $item->price;
        }

        $locations = Location::orderBy('name', 'ASC')->get();

        return view('web.checkout', [
            'active_menu' => 'cart',
            'total_price' => $totalPrice,
            'locations' => $locations
        ]);
    }

    public function pay(Request $request)
    {
        $user = auth()->user();
        if(!empty($user) && $user->user_level != 'User') {
            return redirect()->route('admin.home');
        }

        if(empty($request->image)) {
            return redirect()->back()->with('error_message', 'Silahkan upload bukti pembayaran terlebih dahulu!');
        }

        if(empty($request->location_id)) {
            return redirect()->back()->with('error_message', 'Silahkan pilih alamat pengiriman!');
        }

        $location = Location::where('id', $request->location_id)->first();
        if(empty($location)) {
            return redirect()->back()->with('error_message', 'alamat pengiriman tidak tersedia!');
        }

        $radius = RadiusCheckerService::getDistance((float) $location->latitude, (float) $location->longitude);

        try {
            $radius = (float) $radius;
        } catch (\Exception $e) {
            $radius = 1;
        }

        $radiusInKm = 0;
        if(!empty($radius) && $radius > 0 ) {
            $radiusInKm = $radius / 1000;
        }

        if($radiusInKm > 15) {
            return redirect()->back()->with('error_message', 'Order Gagal! alamat pemesanan melebihi batas radius!');
        }
        
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
        $order->delivery_address = $location->name;
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

            $product = Product::where('id', $orderItem->product_id)->first();
            $product->update([
                'stock' => $product->stock - $orderItem->quantity
            ]);
        }

        return redirect()->route('menu')->with('success_message', 'berhasil melakukan pemesanan!');
    }
}
