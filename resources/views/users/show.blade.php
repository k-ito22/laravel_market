@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <div class="profile">
        <div class="profile_image">
            @if ($user->image !== '')  
                <img src="{{ \Storage::url($user->image) }}" alt="プロフィール画像">
            @else
                <img src="{{ asset('images/no_image.png') }}" alt="プロフィール画像なし">
            @endif
            @if ($user->id === \Auth::user()->id)
                <a href="{{ route('profile.edit_image') }}">画像を変更</a>
            @endif
        </div>
        <div class="profile_name">
            {{ $user->name }}
            @if ($user->id === \Auth::id())
                <a href="{{ route('profile.edit') }}">プロフィール編集</a>
            @endif
        </div>
        <div class='profile_main'>
            @if ($user->profile !== '')
                {{ $user->profile }}
            @endif
        </div>
        <div class='profile_items'>
            @if ($user->id !== \Auth::id())
                <a href="{{ route('users.exhibitions', $user) }}">出品商品一覧</a>
            @endif
        </div>
    </div>
    <h2>購入履歴</h2>
    <ul>
        @forelse ($user->orderItems as $order_item)
            <li>
                <a href="{{ route('items.show', $order_item) }}">
                    <div>
                        {{ $order_item->name }}
                    </div>
                    <img src="{{ \Storage::url($order_item->image) }}" alt="商品画像">
                </a>
            </li>
        @empty
            <li>購入履歴はありません</li>
        @endforelse
    </ul>
@endsection