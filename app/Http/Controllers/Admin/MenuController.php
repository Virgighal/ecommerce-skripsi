<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * index product
     *
     * @param Request $request
     * @return view
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        if(!empty($user) && $user->user_level != 'Admin') {
            return redirect()->route('web.home');
        }
        
        $products = new Product;

        if(!empty($request->type)) {
            $products = $products->where('type', $request->type);
        }

        if(!empty($request->name)) {
            $products = $products->where('name', 'LIKE', '%'.$request->name.'%');
        }

        if(!empty($request->code)) {
            $products = $products->where('code', 'LIKE', '%'.$request->code.'%');
        }

        $products = $products->orderBy('name', 'ASC')->get();

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

        return view('admin.menu.index', [
            'active_menu' => 'menu',
            'products' => $products
        ]);
    }
}
