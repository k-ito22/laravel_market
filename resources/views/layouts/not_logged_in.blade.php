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
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">
                        サインアップ
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">
                        ログイン
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
@endsection