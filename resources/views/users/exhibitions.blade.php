@extends('layouts.logged_in')

@section('title', $title)

@section('content')

<h1>{{ $title }}</h1>
@if ($user->id === \Auth::id())
    <div class="clearfix mb-3">
        <a class="btn btn-secondary float-right" href="{{ route('items.create') }}">新規出品</a>
    </div>
@else
    <a href="{{ route('users.show', $user) }}">プロフィールを表示</a>
@endif
<ul class="items">
    @forelse($items as $item)
        <li class="item">
            <div class="item_header">
                出品者: {{ $item->user->name }}
                ({{ $item->created_at }})
            </div>
            <div class="item_body">
                <div class="item_body_img">
                    <a href="{{ route('items.show', $item) }}">
                        <img src="{{ \Storage::url($item->image) }}">
                    </a>
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
                <div>
                    状態:
                    @if ($item->orders->count()>0)
                        <span>売り切れ</span>
                    @else
                        <span>出品中</span>
                    @endif
                </div>
                @if ($user->id === \Auth::id())
                    <div class="item_footer">
                        <a href="{{ route('items.edit', $item) }}">[編集]</a>
                        <a href="{{ route('items.edit_image', $item) }}">[画像を変更]</a>
                        <form method="post" action="{{ route('items.destroy', $item) }}">
                            @csrf
                            @method('DELETE')
                            <button>削除</button>
                        </form>
                    </div>
                @endif
            </div>
        </li>
    @empty
        <li>商品はありません。</li>
    @endforelse
</ul>

@endsection