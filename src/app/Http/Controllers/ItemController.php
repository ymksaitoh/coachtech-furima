<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\storage;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\ExhibitionRequest;
use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Category;
use App\Models\user;
use App\Models\Purchase;

class ItemController extends Controller
{

  public function index(Request $request)
  {
    $tab = $request->tab ?? 'recommend';

    $query = Item::query();

    if ($request->filled('keyword')) {
      $keyword = $request->input('keyword');
      $query->where('item_name', 'LIKE', "%{$keyword}%");
    }

    if($tab === 'recommend') {

      if(auth()->check()) {
        $query->where('user_id', '!=', auth()->id());
      }

      $items = $query->get();

    } elseif ($tab === 'mylist') {

        if (auth()->check()) {
            $user = auth()->user();
            $items = $query->whereHas('favoritedBy', function($q) use ($user) {
              $q->where('user_id', $user->id);
            })->get();
        } else {

            $items = collect();
        }

      } else {
        $items = collect();
      }

      $purchasedItemIds = Purchase::pluck('item_id')->toArray();

        return view('index', compact('items', 'tab', 'purchasedItemIds'));
      }

  public function mypage(Request $request)
  {
    $tab = $request->tab ?? 'sell';

    if ($tab === 'sell') {
      $items = Item::withCount('purchases')
      ->where('user_id', auth()->id())
      ->get();

    } elseif ($tab === 'buy') {
      $items = Item::withCount('purchases')
      ->whereIn('id', auth()->user()->purchases->pluck('item_id'))
      ->get();

    } else {
      $items = collect();

    }
    return view('mypage', compact('items', 'tab'));
  }

  public function store(ExhibitionRequest $request)
  {

    $item = new Item();
    $item->fill($request->validated());
    $item->user_id = auth()->id();

    if ($request->hasFile('item_img_file')) {
        $path = Storage::disk('public')->putFile('items', $request->file('item_img_file'));
        $item->item_img_file = basename($path);
    }

    $item->save();

    if ($request->category) {
      $item->categories()->sync($request->category);
    }
    return redirect()->route('mypage');
  }

    public function detail(Item $item)
    {
      $item->load(['categories', 'comments.user', 'favoritedBy']);

      $comments = $item->comments;
      $commentsCount = $comments->count();

      return view('detail', compact('item', 'comments', 'commentsCount'));
    }

    public function sell()
    {
      $categories = Category::all();

      return view('/sell', compact('categories'));
    }

}