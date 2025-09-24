<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use App\Models\Item;
use App\Models\Profile;
use App\Models\Purchase;

class UserController extends Controller
{
    public function editProfile()
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile();

        return view('profile', compact('user', 'profile'));
    }

    public function updateProfile(Request $request)
    {

        $user = Auth::user();

        $request->validate([
            'name' => 'required|max:20',
            'postcode' => 'required|max:8',
            'address' => 'required',
            'building' => 'nullable',
            'user_img_file' => 'nullable|image|max:2048',
        ]);

        $user->update(['name' => $request->name]);

        $profileData = $request->only('postcode', 'address', 'building');

        if ($request->hasFile('user_img_file')) {
            $profileData['user_img_file'] = basename($request->file('user_img_file')->store('users', 'public'));
        }

        $profile = $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $profileData
        );

        $user->refresh();

        return redirect()->route('products.index');
    }

    public function mypage(Request $request)
    {
        $user = Auth::user();
        $tab = $request->get('tab', 'sell');
        if ($tab === 'sell') {
            $items = $user->items;
        } elseif ($tab === 'buy') {
            $items = Purchase::with('item')
            ->where('user_id', $user->id)
            ->get()
            ->map(function($purchase) {
                return $purchase->item;
            })
            ->filter();

        } else {
            $items = collect();
        }
        return view('mypage' , compact('user', 'items', 'tab'));
    }

    public function editAddress($item_id)
    {
        $user = auth()->user();
        $profile = $user->profile ?? new Profile();

        return view('update', compact('user','profile', 'item_id'));
    }

    public function updateAddress(Request $request, $item_id)
    {
        $user = auth()->user();
        $request->validate([
            'postcode' => 'required|max:8',
            'address' => 'required',
            'building' => 'nullable',
        ]);

        $profileData = $request->only('postcode', 'address', 'building');

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $profileData
        );

        return redirect()->route('purchase.index', ['item_id' => $item_id]);
    }
}