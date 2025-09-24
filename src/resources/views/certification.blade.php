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
        @php
            $signedUrl = URL::temporarySignedRoute(
                'verification.verify',
                now()->addDays(7),
                ['id' => auth()->user()->id, 'hash' => sha1(auth()->user()->email)]
            );
        @endphp

        <a class="certification-form__btn btn" href="http://localhost:8025" target="_blank">認証はこちらから</a>
    </div>

    <div class="certification-form__mail">
        <form action="{{ route('verification.send') }}" method="post" style="margin-top: 10px;">
            @csrf
            <input class="certification-form__btn resend" type="submit" value="認証メールを再送する">
        </form>
    </div>
</div>
@endsection