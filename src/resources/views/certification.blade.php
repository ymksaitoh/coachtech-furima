@extends('auth.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/certification.css') }}">
@endsection

@section('content')
<div class="certification-form">
    <p class="certification-form__message">
        登録していただいたメールアドレスに認証メールを送付しました。<br>
        メール認証を完了して下さい
    </p>

    <div class="certification-form__btn">
        <form action="{{ route('verification.send') }}" method="post">
            @csrf
            <input type="submit" class="certification-form__btn" value="認証はこちらから">
        </form>
    </div>

    <div class="certification-form__mail">
        <form action="{{ route('verification.send') }}" method="post">
            @csrf
            <input type="submit" class="certification-form__btn resend" value="認証メールを再送する">
        </form>
    </div>
</div>
@endsection