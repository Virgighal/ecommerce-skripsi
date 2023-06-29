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

            $totalRatingSubmission = 0;
            $totalRatingValue = 0;
            $averageRating = 0;
            $query = Rating::where('rateable_id', $product->id);
            
            $totalRatingSubmission = $query->count();
            $totalRatingValue = $query->sum('rating');

            if($totalRatingSubmission != 0 && $totalRatingValue) {
                $averageRating = $totalRatingValue / $totalRatingSubmission;
            }

            $product->rating_star =  floor($averageRating);
            $product->average_rating =  $averageRating;
        };

        return view('web.menu', [
            'active_menu' => 'menu',
            'products' => $products
        ]);
    }
}
