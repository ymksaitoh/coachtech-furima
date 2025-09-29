<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'recommend');
        $user = auth()->user();

        if($tab === 'recommend') {
            $items = Item::all();
        } elseif ($tab === 'mylist' && $user) {
            $items = $user->favorites()->with('item')->get()->pluck('item');
        } else {
            $items = collect();
            }

        return view('index', compact('items', 'tab', 'user'));
    }

}