@extends('auth.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection


@section('content')
@php
    $purchasedItemIds = \App\Models\Purchase::pluck('item_id')->toArray() ?? [];
@endphp

<div class="content index-content index-content--top">
    <div class="index-form__tab-wrapper">
        <div class="index-form__tab">
            <a href="{{ route('products.index', array_merge(request()->except('tab'), ['tab' => 'recommend'])) }}"
            class="{{ request('tab') === 'recommend' ? 'active' : '' }}">おすすめ</a>

            <a href="{{ route('products.index', array_merge(request()->except('tab'), ['tab' => 'mylist'])) }}"
                class="{{ request('tab') === 'mylist' ? 'active' : '' }}">マイリスト</a>
        </div>
    </div>

    <div class="index-form">
        @if($items->isNotEmpty())
            @foreach($items as $item)
                <div class="index-form__card">
                    <a href="{{ route('item.detail', ['item' => $item->id]) }}">
                        <img src="{{ asset('storage/items/' . $item->item_img_file) }}" alt="{{ $item->name }}">
                    </a>
                    <div class="index-form__name-wrapper">
                        <p class="index-form__name">{{ $item->item_name }}</p>
                        @if(in_array($item->id, $purchasedItemIds))
                            <span class="index-form__sold-badge">SOLD</span>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>

</div>
@endsection