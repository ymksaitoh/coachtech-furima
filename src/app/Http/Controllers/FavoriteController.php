<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function favorite(Request $request)
    {
        $itemId = $request->item_id;
        $userId = auth()->id();

        $item = Item::findOrFail($itemId);

        $favorite = Favorite::where('item_id', $itemId)
                            ->where('user_id', $userId)
                            ->first();
        if ($favorite) {
            $favorite->delete();
            $favorited = false;
        } else {
            Favorite::create([
                'item_id' => $itemId,
                'user_id' => $userId,
            ]);
            $favorited = true;
        }

        $count = $item->favoritedBy()->count();

        return back();
    }
}
