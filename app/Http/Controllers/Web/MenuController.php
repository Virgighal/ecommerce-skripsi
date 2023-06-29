<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Rating;

class MenuController extends Controller
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
        
        $products = Product::get();

        foreach($products as $product) {
            $rating = Rating::where('rateable_id', $product->id)->first();

            $ratingStar = 0;
            if(!empty($rating)) {
                $ratingStar = $rating->rating;
            }

            $product->rating_star =  $ratingStar;
        }

        return view('web.menu', [
            'active_menu' => 'menu',
            'products' => $products
        ]);
    }
}
