<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Favourite;

class FavouriteController extends Controller
{
    function addToFavourites(Request $request, $product_id)
    {
        $user = auth('api')->user();

        Favourite::create([
            'customer_id' => $user->id,
            'product_id' => $product_id,
        ]);

        return response()->json(['message' => 'Product added to favourites']);
    }

    function removeFromFavourites(Request $request, $product_id)
    {
        $user = auth('api')->user();

        Favourite::where([
            'customer_id' => $user->id,
            'product_id' => $product_id,
        ])->delete();

        return response()->json(['message' => 'Product removed from favourites']);
    }

    function getFavourites(Request $request)
    {
        $user = auth('api')->user();

        $favourites = Favourite::where('customer_id', $user->id)->with('product')->get();

        return response()->json($favourites);
    }
}
