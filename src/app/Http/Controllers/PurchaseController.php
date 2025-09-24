<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function purchase($item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = auth()->user();
        $selectedPayment = request('payment');

        return view('purchase', compact('item', 'user', 'selectedPayment'));
    }

    public function store(Request $request, $item_id)
    {
        $item = Item::findOrFail($item_id);

        $request->validate([
            'payment' => 'required|string',
        ]);

        Purchase::create([
            'user_id' => Auth::id(),
            'item_id' => $item->id,
            'payment' => $request->payment,
        ]);

        $item->update(['is_sold' => true]);

        return redirect()->route('products.index');

    }

    public function session(Request $request, $item_id)
    {
        $item = Item::findOrFail($item_id);

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->item_name,
                    ],
                    'unit_amount' => $item->price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
            ]);

            return redirect($session->url);
    }
}