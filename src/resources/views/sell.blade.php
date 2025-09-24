@extends('auth.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="sell-form">
    <h2 class="sell-form__heading content__heading">商品の出品</h2>
        <div class="edit-form__inner">
        <form class="edit-form__form" action="{{ route('sell.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="sell-form__group">
                <label class="sell-form__label">商品画像</label>

                <div class="sell-form__img">
                    <input type="file" name="item_img_file" id="item_img_file" accept="image/png,image/jpeg" hidden>
                    <button type="button" class="sell-form__img-btn btn" onclick="document.getElementById('item_img_file').click()">画像を選択する</button>
                </div>
            </div>

            <h3 class="sell-form__title content__title">商品の詳細</h3>
            <label class="sell-form__label" for="category">カテゴリー</label>
            <div class="sell-form__group">
                @foreach($categories as $category)
                    <input type="checkbox" id="category{{ $category->id }}"  name="category[]" value="{{ $category->id }}">
                    <label for="category{{ $category->id }}" class="sell-form__checkbox-label">{{ $category->content }}</label>
                @endforeach
                <p class="sell-form__error-message">
                    @error('category')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="sell-form__group">
                <label class="sell-form__label" for="condition">商品の状態</label>
                <select class="sell-form__select" name="condition" id="">
                    <option disabled selected>選択してください</option>
                    <option value="良好">良好</option>
                    <option value="目立った傷や汚れなし">目立った傷や汚れなし</option>
                    <option value="やや傷や汚れあり">やや傷や汚れあり</option>
                    <option value="状態が悪い">状態が悪い</option>
                </select>
            </div>
            <h3 class="sell-form__title content__title">商品名と説明</h3>
            <div class="sell-form__group">
                <label class="sell-form__label" for="item_name">商品名</label>
                <input class="sell-form__input" type="text" name="item_name" id="item_name">
                <p class="sell-form__error-message">
                    @error('item_name')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="sell-form__group">
                <label class="sell-form__label" for="brand_name">ブランド名</label>
                <input class="sell-form__input" type="text" name="brand_name" id="brand_name">
                <p class="sell-form__error-message">
                    @error('brand_name')
                    {{ $message}}
                    @enderror
                </p>
            </div>
            <div class="sell-form__group">
                <label class="sell-form__label" for="detail">商品の説明</label>
                <textarea class="sell-form__input" name="detail" id="detail"></textarea>
                <p class="sell-form__error-message">
                    @error('detail')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="sell-form__group">
                <label class="sell-form__label" for="price">販売価格</label>
                <input class="sell-form__input" type="price" name="price" id="price" placeholder="¥">
                <p class="sell-form__error-message">
                    @error('price')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <input class="sell-form__btn btn" type="submit" value="出品する">
        </form>
    </div>
</div>
@endsection