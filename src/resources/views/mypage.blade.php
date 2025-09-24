@extends('auth.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
@php
    $purchasedItemIds = auth()->user()->purchases->pluck('item_id')->toArray() ?? [];
@endphp

<div class="mypage-form">
    <div class="mypage-form__header">
        @if($user->profile?->user_img_file)
            <img class="mypage-form__user-img" src="{{ asset('storage/users/' . $user->profile->user_img_file) }}" alt="{{ $user->name ?? 'プロフィール未登録' }}">
        @else
            <div class="mypage-form__user-img-placeholder"></div>
        @endif
        <h2 class="mypage-form__user_name ">{{ $user->name }}</h2>
        <a class="mypage-form__btn btn" href="{{ route('profile.edit') }}">プロフィールを編集</a>
    </div>

    <div class="mypage-form__tab">
        <a href="{{ route('mypage', ['tab' => 'sell']) }}"
            class="{{ $tab === 'sell' ? 'active' : '' }}">出品した商品</a>
        <a href="{{ route('mypage', ['tab' => 'buy']) }}"
            class="{{ $tab === 'buy' ? 'active' : '' }}">購入した商品</a>
    </div>

    <div class="mypage-form__underline"></div>

    <div class="mypage-form__cards">
        @foreach($items as $item)
            <div class="mypage-form__card">
                <a href="{{ route('item.detail', ['item' => $item->id]) }}">
                    <img src="{{ asset('storage/items/' . $item->item_img_file) }}" alt="{{ $item->name }}">
                </a>
                <p>{{ $item->item_name }}</p>

                @if($item->purchases->isNotEmpty())
                    <span class="mypage-form__sold-badge">SOLD</span>
                @endif
            </div>
        @endforeach
    </div>
</div>

@endsection