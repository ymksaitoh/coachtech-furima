<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        if(!auth()->check()) {
            return redirect()->back()->withErrors([
                'comment' => 'コメント送信にはログインが必要です。',
            ]);
        }
        
        auth()->user()->comments()->create([
            'item_id' => $request->item_id,
            'comment' => $request->comment,
        ]);

        return redirect()->back();
    }
}
