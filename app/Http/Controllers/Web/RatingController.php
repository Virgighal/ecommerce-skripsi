<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * rating
     *
     * @param Request $request
     * @param [type] $rateableType
     * @param [type] $rateableId
     * 
     */
    public function rating(Request $request, $rateableType, $rateableId) 
    {
        $productObject =  Product::where('id', $rateableId)->first();
        if(empty($productObject)) {
            return redirect()->back()->with('error_message', 'product tidak ditemukan!');
        }

        return view('web.rating', [
            'active_menu' => 'rating',
            'product' => $rateableType,
            'product_id' => $rateableId,
            'product_object' => $productObject
        ]);
    }   

    /**
     * SAVE RATING
     *
     * @param Request $request
     * @param [type] $rateableType
     * @param [type] $rateableId
     * 
     */
    public function store(Request $request, $rateableType, $rateableId)
    {
        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $rateableModel = $rateableType::findOrFail($rateableId);

        Rating::where('rateable_id', $rateableId)->delete();

        $rating = new Rating([
            'rating' => $validatedData['rating'],
            'user_id' => auth()->user()->id
        ]);

        $rateableModel->ratings()->save($rating);

        return redirect()->route('profile')->with('success_message', 'berhasil memberikan rating!');
    }
}
