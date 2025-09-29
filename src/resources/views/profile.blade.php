@extends('auth.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="profile-form">
    <h2 class="profile-form__heading content__heading">プロフィール設定</h2>

    <form class="profile-form__form" action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="profile-form__group">
            <div class="profile-form__img">
                @if($profile->user_img_file)
                    <img id="user_img_file"
                        src="{{ asset('storage/users/' . $profile->user_img_file) }}" alt="プロフィール画像" class="profile-form__img-preview">
                @else
                    <div class="profile-form__img-placeholder"></div>
                @endif

                <input class="profile-form__img-input"
                        id="user_img_input" type="file" name="user_img_file" accept="image/png,image/jpeg" hidden />
                <button class="profile-form__img-btn btn" type="button" onclick="document.getElementById('user_img_input').click()">画像を選択する</button>
            </div>
        </div>

        <div class="profile-form__group">
            <label class="profile-form__label" for="name">ユーザー名</label>
            <input class="profile-form__input" type="text" name="name" id="name" value="{{ old('name', $user->name) }}">
        </div>

        <div class="profile-form__group">
            <label class="profile-form__label" for="postcode">郵便番号 </label>
            <input class="profile-form__input" type="text" name="postcode" id="postcode" value="{{ old('postcode', $profile->postcode ?? '') }}">
        </div>

        <div class="profile-form__group">
            <label class="profile-form__label" for="address">住所</label>
            <input class="profile-form__input" type="text" name="address" id="address" value="{{ old('address', $profile->address ?? '') }}">
        </div>

        <div class="profile-form__group">
            <label class="profile-form__label" for="building">建物名</label>
            <input class="profile-form__input" type="text" name="building" id="building" value="{{ old('building', $profile->building ?? '') }}">
        </div>

        <input class="profile-form__btn btn" type="submit" value="更新する">
    </form>

</div>
@endsection