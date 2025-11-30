<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Shop;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $shopId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $shop = Shop::findOrFail($shopId);

        $existingReview = Review::where('user_id', auth()->id())
            ->where('shop_id', $shopId)
            ->first();

        if ($existingReview) {
            $existingReview->update([
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);
        } else {
            Review::create([
                'user_id' => auth()->id(),
                'shop_id' => $shopId,
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);
        }

        $shop->average_rating = $shop->reviews()->avg('rating');
        $shop->total_reviews = $shop->reviews()->count();
        $shop->save();

        return redirect()->back()->with('success', 'Review submitted successfully!');
    }
}
