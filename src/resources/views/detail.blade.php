@extends('auth.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail-form">
    <div class="detail-form__left">
        <div class="detail-form__img">
            <img src="{{ asset('storage/items/' . $item->item_img_file) }}" alt="{{ $item->name }}">
        </div>
    </div>

    <div class="detail-form__right">
        <div class="detail-form__inner">
            <h2 class="detail-form__item-name">{{ $item->item_name }}</h2>
            <p class="detail-form__brand-name">{{ $item->brand_name }}</p>
            <h3 class="detail-form__pride">¥{{ number_format($item->price) }}（税込）</h3>

            <div class="detail-form__meta">
                @if(auth()->check())
                    <form method="post" action="{{ route('item.favorite') }}">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <button class="detail-form__favorite-btn" type="submit">
                            @if($item->favoritedBy()->where('user_id', auth()->id())->exists())
                            <img class="icon" src="{{ asset('storage/star_yellow.png') }}" alt="お気に入り済み">
                            @else
                                <img class="icon" src="{{ asset('storage/star.png') }}" alt="お気に入り">
                            @endif
                            <span class="count">{{ $item->favoritedBy()->count() }}</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="detail-form__favorite-btn">
                        @if($item->favoritedBy()->count() > 0)
                        <img class="icon" src="{{ asset('storage/star_yellow.png') }}" alt="お気に入り済み">
                        @else
                        <img class="icon" src="{{ asset('storage/star.png') }}" alt="お気に入り">
                        @endif
                        <span class="count">{{ $item->favoritedBy()->count() }}</span>
                    </a>
                @endif

                <div class="detail-form__comment-count">
                    <img src="{{ asset('storage/comment.png') }}" alt="コメント" class="icon">
                    <span class="count">{{ $commentsCount }}</span>
                </div>
            </div>
        </div>

        <div class="detail-form__purchase">
            @auth
                <a href="{{ route('purchase.index', ['item_id' => $item->id]) }}" class="detail-form__buy-btn btn">
                購入手続きへ
                </a>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="detail-form__buy-btn btn">
                購入手続きへ
                </a>
            @endguest
        </div>

        <div class="detail-form__group">
            <h3 class="detail-form__title content__title">商品説明</h3>
            <p class="detail-form__detail">{{ $item->detail }}</p>
        </div>

        <div class="detail-form__group">
            <h3 class="detail-form__title content__title">商品の情報</h3>
            <label class="detail-form__label" for="category">カテゴリー</label>
            <div class="detail-form__category">
                @foreach($item->categories as $category)
                    <span class="detail-form__category-item">{{ $category->content }}</span>
                @endforeach
            </div>
            <label class="detail-form__label" for="condition">商品の状態</label>
            <p class="detail-form__condition">{{ $item->condition }}</p>
        </div>

        <div class="detail-form__comment">
            <h3 class="detail-form__title content__title">コメント ({{ $commentsCount }})</h3>

            @if($comments->isNotEmpty())
                @foreach($comments as $comment)
                    <div class="detail-form__comment-list">
                        <div class="detail-form__comment-user-wrapper">
                            @if($comment->user?->profile?->user_img_file)
                                <img class="detail-form__user-img" src="{{ asset('storage/users/' . $comment->user->profile->user_img_file) }}" alt="{{ $comment->user->name ?? 'ユーザー名未登録' }}">
                            @else
                                <div class="detail-form__user-img-placeholder"></div>
                            @endif
                            <p class="detail-form__comment-user">{{ $comment->user->name ?? 'ユーザー名未登録' }}</p>
                        </div>
                        <p class="detail-form__comment-text">{{ $comment->comment }}</p>
                    </div>
                    @error('comment')
                        <div class="detail-form__error">{{ $message }}</div>
                    @enderror
                @endforeach
            @endif
        </div>

        <form class="detail-form__comment-form" action="{{ route('comment.store') }}" method="post">
            @csrf
            <input type="hidden" name="item_id" value="{{ $item->id }}">

            <label class="detail-form__label" for="comment">商品へのコメント</label>
            <input class="detail-form__comment-input" type="text" name="comment" id="comment" value="{{ old('comment') }}">

            @error('comment')
                <div class="detail-form__comment-error">{{ $message }}</div>
            @enderror

            <button type="submit" class="detail-form__comment-btn btn">
                コメントを送信する
            </button>
        </form>
    </div>
</div>
@endsection