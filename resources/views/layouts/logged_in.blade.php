@extends('layouts.default')

@section('header')
<header>
    <nav class="navbar navbar-expand-sm fixed-top bg-light navbar-light">
        <a href="{{ route('items.index') }}" class="navbar-brand">Market</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav">
                <li class="nav-item user-name">
                        {{ Auth::user()->name }}さん
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.show', Auth::user()) }}" class="nav-link">
                        プロフィール
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('likes.index') }}" class="nav-link">
                        お気に入り一覧
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.exhibitions', Auth::user()) }}" class="nav-link">
                        出品商品一覧
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <input type="submit" class="nav-link" value="ログアウト">
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</header>
@endsection