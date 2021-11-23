@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<h1>{{ $title }}</h1>
<ul class="items">
    <li class="item">
        <div class="item_header">
            出品者: 
            <a href="{{ route('users.show', $item->user) }}">
                {{ $item->user->name }}
            </a>
            ({{ $item->created_at }})
        </div>
        <div class="item_body">
            <div class="item_img">
                <img src="{{ \Storage::url($item->image) }}">
            </div>
            <div class="item_body_description">
                商品詳細: {{ $item->description }} 
            </div>
            <div class="item_body_category">
                カテゴリー: {{ $item->category->name }} 
            </div>
            <div class="item_body_price">
                価格: {{ $item->price }} 円
            </div>
        </div>
        <div>
            @if ($item->orders->count()>0)
                <span>売り切れ</span>
            @else
                @if ($item->user->id !== \Auth::id())
                <form method="post" action="{{ route('items.confirm', $item) }}">
                    @csrf
                    <button>購入する</button>
                </form>
                @endif
            @endif
        </div>
    </li>
</ul>
@endsection