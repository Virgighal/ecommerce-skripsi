<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingsController extends Controller
{
    /**
     * index
     *
     * @param Request $request
     * @return view
     */
    public function index(Request $request)
    {
        $ratings = new Rating();

        if(!empty($request->name)) {
            $ratings = $ratings->whereHas('user', function($query) use($request) {
                $query->where('name', 'LIKE', '%', $request->name, '%');
            });
        }

        if(!empty($request->email)) {
            $ratings = $ratings->whereHas('user', function($query) use($request) {
                $query->where('email', $request->email);
            });
        }

        if(!empty($request->product_name)) {
            $product = Product::where('name', 'LIKE', '%'.$request->product_name.'%')->first();
            if(!empty($product)) {
                $ratings = $ratings->where('rateable_id', $product->id);
            }
        }

        $ratings = $ratings->groupBy('user_id', 'rateable_id')->orderBy('id', 'DESC')->paginate(25);

        foreach($ratings as $rating) {
            $rating->product = NULL;
            $product = Product::where('id', $rating->rateable_id)->first();
            if(!empty($product)) {
                $rating->product = $product;
            }
        }

        return view('admin.ratings.index', [
            'active_menu' => 'menu',
            'ratings' => $ratings
        ]);
    } 
}
