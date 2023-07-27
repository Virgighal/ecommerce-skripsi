<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Location;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
    
    public function updateCartItem(Request $request)
    {
        $user = auth()->user();
        if(!empty($user) && $user->user_level != 'User') {
            return redirect()->route('admin.home');
        }

        $quantity = $request->quantity;
        $price = $request->price;
        $total = $request->total;
        $cartItemId = $request->cart_item_id;

        $cartItem = CartItem::where('id', $cartItemId)->first();
        if(!empty($cartItem)) {
            $cartItem->quantity = $quantity;
            $cartItem->price = $total;
            $cartItem->save();
        }

        return response()->json([
            'error' => false,
            'success_message' =>'successfully updated cart item.'
        ]);
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

        $deliveryFee = 0;

        if($request->payment_method == 'COD' || $request->payment_method == 'Dikirim') {
            if(empty($request->image)) {
                return redirect()->back()->with('error_message', 'Silahkan upload bukti pembayaran');
            }

            if(empty($request->address)) {
                return redirect()->back()->with('error_message', 'Silahkan isi alamat pengiriman');
            }

            if(!empty($request->delivery_fee)) {
                $deliveryFee = $request->delivery_fee;
            }
        }

        DB::transaction(function() use($request, $user, $deliveryFee) {
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
            $order->status = ($request->payment_method == 'Langsung') ? 'Pesanan Selesai' : 'Menunggu Konfirmasi';
            $order->delivery_address = $request->address;
            $order->transaction_number = Carbon::now()->format('YmdHis') . rand (0, 99);
            $order->payment_method = $request->payment_method;
            $order->delivery_fee = $deliveryFee;
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

            if($order->status == 'Menunggu Konfirmasi') {
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
            }
        });

        return redirect()->route('menu')->with('success_message', 'berhasil melakukan pemesanan!');
    }
}
