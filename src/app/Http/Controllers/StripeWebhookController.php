<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Item;
use Illuminate\Support\Facades\Log;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $event = $request->all();

        if ($event['type'] === 'checkout.session.completed') {
            $session = $event['data']['object'];
            
            $itemId = $session['metadata']['item_id'] ?? null;
            $userId = $session['metadata']['user_id'] ?? null;
            
            if ($itemId && $userId){
                $item = Item::find($itemId);

                if ($item && !$item->is_sold) {
                    Purchase::create([
                        'user_id' => $userId,
                        'item_id' => $item->id,
                        'payment' => 'card',
                    ]);

                    $item->update(['is_sold' => true]);
                }
            }
        }
        return response()->json(['status' => 'success']);
    }
}
