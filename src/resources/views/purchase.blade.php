@extends('auth.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
@php
    $user = auth()->user();
    $profile = $user->profile;
    $selectedPayment = request('payment');
@endphp

<div class="purchase-form">
    <div class="purchase-form__left">
        <div class="purchase-form__card">
            <img src="{{ asset('storage/items/' . $item->item_img_file) }}" alt="{{ $item->item_name }}">
            <div>
                <p class="purchase-form__item-name">{{ $item->item_name }}</p>
                <p class="purchase-form__item-price">¥{{ number_format($item->price) }}</p>
            </div>
        </div>

        <div class="purchase-form__group">
            <label class="purchase-form__label" for="payment">支払い方法</label>
            <form action="{{ route('purchase.index', ['item_id' => $item->id]) }}" method="get">
                <select class="purchase-form__select" name="payment" id="payment" onchange="this.form.submit()">
                    <option value="" disabled {{ $selectedPayment ? '' : 'selected' }}>選択してください</option>
                    <option value="convenience_store" {{ $selectedPayment=='convenience_store' ? 'selected' : '' }}>コンビニ払い</option>
                    <option value="credit_card" {{ $selectedPayment=='credit_card' ? 'selected' : '' }}>カード払い</option>
                </select>
            </form>
        </div>

        <div class="purchase-form__group purchase-form__address">
            <div class="purchase-form__address-header">
                <label class="purchase-form__label" for="address">配送先</label>
                <div class="purchase-form__address-update">
                    <a class="purchase-form__update-link" href="{{ route('address.edit', ['item_id' => $item->id]) }}">
                    変更する
                    </a>
                </div>
            </div>

            <div class="purchase-form__address-detail">
                <p class="purchase-form__postcode">{{ $profile->postcode ?? '-' }}</p>
                <p class="purchase-form__address">{{ $profile->address ?? '-' }}</p>
                <p class="purchase-form__building">{{ $profile->building  ?? '-' }}</p>
            </div>
        </div>
    </div>

    <div class="purchase-form__right">
        <table class="purchase-form__group-payment">
            <tr class="purchase-form__row">
                <th class="purchase-form__label">商品代金</th>
                <td class="purchase-form__price">¥{{ number_format($item->price) }}</td>
            </tr>
            <tr class="purchase-form__row">
                <th class="purchase-form__label">支払い方法</th>
                <td class="purchase-form__payment">
                    @if($selectedPayment == 'convenience_store')
                        コンビニ払い
                    @elseif($selectedPayment == 'credit_card')
                        カード払い
                    @else
                        ー
                    @endif
                </td>
            </tr>
        </table>

        @if($item->is_sold)
            <button class="purchase-form__btn btn" type="button" disabled>SOLD</button>
        @else
            @if($selectedPayment == 'credit_card')
                <form class="purchase-form__action" action="{{ route('checkout.session', ['item_id' => $item->id]) }}" method="post">
                    @csrf
                    <input type="hidden" name="payment" value="{{ $selectedPayment }}">
                    <button class="purchase-form__btn btn" type="submit">購入する</button>
                </form>
            @else
                <form class="purchase-form__action" action="{{ route('purchase.store', ['item_id' => $item->id]) }}" method="post">
                    @csrf
                    <input type="hidden" name="payment" value="{{ $selectedPayment }}">
                    <button class="purchase-form__btn btn" type="submit" {{ $selectedPayment ? '' : 'disabled' }}>購入する</button>
                </form>
            @endif
        @endif
    </div>
</div>
@endsection