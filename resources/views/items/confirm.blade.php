@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<h1>{{ $title }}</h1>
<a href="{{ route('items.create') }}">新規出品</a>
<ul class="items">
    <li class="item">
        <div class="item_header">
            出品者: {{ $item->user->name }}
            ({{ $item->created_at }})
        </div>
        <div class="item_body">
            <div class="item_body_img">
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
        <form method="post" action="{{ route('items.finish', $item) }}">
            @csrf
            <button>内容を確認し、購入する</button>
        </form>
    </li>
</ul>
@endsection