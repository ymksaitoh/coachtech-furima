@extends('auth.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/update.css') }}">
@endsection

@section('content')
<div class="update-form">
    <h2 class="update-form__heading content__heading">住所の変更</h2>
    <div class="update-form__inner">
        <form class="update-form__form" action="{{ route('address.update', ['item_id' => $item_id]) }}" method="post">
            @csrf
            <div class="update-form__group">
                <label class="update-form__label" for="postcode">郵便番号 </label>
                <input class="update-form__input" type="text" name="postcode" id="postcode" value="{{ old('postcode', $profile->postcode) }}">
            </div>

            <div class="update-form__group">
                <label class="update-form__label" for="address">住所</label>
                <input class="update-form__input" type="text" name="address" id="address" value="{{ old('address', $profile->address) }}">
            </div>

            <div class="update-form__group">
                <label class="update-form__label" for="building">建物名</label>
                <input class="update-form__input" type="text" name="building" id="building" value="{{ old('building', $profile->building) }}">
            </div>

            <input class="update-form__btn btn" type="submit" value="更新する">
        </form>
    </div>
</div>
@endsection