@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<h1>{{ $title }}</h1>
<div class="clearfix mb-3">
    <a class="btn btn-secondary float-right" href="{{ route('items.create') }}">新規出品</a>
</div>
<section>
    <h2>新着商品</h2>
    <ul class="items row list-unstyled">
        @forelse($items as $item)
            <li class="col-lg-4 col-sm-6 col-12 mt-3 mb-2">
                <div class="item card border-secondary">
                    <div class="item_header ml-2 mr-2">
                        出品者:
                        <a href="{{ route('users.show', $item->user) }}">
                            {{ $item->user->name }}
                        </a><br>
                        ({{ $item->created_at }})
                    </div>
                    <div class="item_body ml-2 mr-2">
                        <div class="item_body_img">
                            <a class="item_link d-flex align-items-center justify-content-center border mt-2 mb-2" href="{{ route('items.show', $item) }}">
                                <img class="item_image" src="{{ \Storage::url($item->image) }}">
                            </a>
                        </div>
                        <div class="item_body_name">
                            商品名: {{ $item->name }} 
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
                    </div>
                    <div class="d-flex">
                        <div class="ml-2">
                            <a class="submit_button">{{ $item->isLikedBy(\Auth::user()) ? '★' : '☆' }}</a>
                            <span>{{ $item->likeCount() }}</span>
                            <form method="post" action="{{ route('likes.toggle') }}">
                                @csrf
                                <input type="hidden" value="{{ $item->id }}" name="item_id">
                            </form>
                        </div>
                        <div class="ribbons ml-auto mr-2 d-flex">
                            <div>
                                <i class="fa fa-ribbon submit_button mr-1 {{ $item->isTaggedRedBy(\Auth::user()) ? 'tagged' : 'not_tagged' }}" style="color: red;"></i>
                                <form method="post" action="{{ route('ribbons.toggle_red') }}">
                                    @csrf
                                    <input type="hidden" value="{{ $item->id }}" name="item_id">
                                </form>
                            </div>
                            <div>
                                <i class="fa fa-ribbon submit_button mr-1 {{ $item->isTaggedBlueBy(\Auth::user()) ? 'tagged' : 'not_tagged' }}" style="color: blue;"></i>
                                <form method="post" action="{{ route('ribbons.toggle_blue') }}">
                                    @csrf
                                    <input type="hidden" value="{{ $item->id }}" name="item_id">
                                </form>
                            </div>
                            <div>
                                <i class="fa fa-ribbon submit_button {{ $item->isTaggedGreenBy(\Auth::user()) ? 'tagged' : 'not_tagged' }}" style="color: green;"></i>
                                <form method="post" action="{{ route('ribbons.toggle_green') }}">
                                    @csrf
                                    <input type="hidden" value="{{ $item->id }}" name="item_id">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @empty
            <li>商品はありません。</li>
        @endforelse
    </ul>
    @if($items->count() > 0)
        <div class="row">
            <a href="{{ route('items.display') }}" class="col-3 col-md-2 ml-auto mr-4 mb-5 btn btn-warning">もっと見る</a>
        </div>
    @endif
</section>

<section>
    <h2>リボン付き商品</h2>
    <p>気になった商品にリボンを付けて比較しよう</p>
    <ul class="nav nav-tabs">
        <li class="nav-item ribbon-tab-red">
            <a href="#contents1" class="nav-link active text-danger" data-toggle="tab"><i class="fa fa-ribbon" style="color:red;"></i> 赤リボン</a>
        </li>
        <li class="nav-item ribbon-tab-blue">
            <a href="#contents2" class="nav-link txte-primary" data-toggle="tab"><i class="fa fa-ribbon" style="color:blue;"></i> 青リボン</a>
        </li>
        <li class="nav-item ribbon-tab-green">
            <a href="#contents3" class="nav-link text-success" data-toggle="tab"><i class="fa fa-ribbon" style="color:green;"></i> 緑リボン</a>
        </li>
    </ul>
    <div class="tab-content">
        <div id="contents1" class="tab-pane active">
            <div class="border border-danger mb-3">
                <div class="row">
                    @forelse($red_items as $item)
                        <div class="col-4">
                            <div class="ribbon_item_image">
                                <a class="ribbon_item_link d-flex align-items-center justify-content-center" href="{{ route('items.show', $item) }}">
                                    <img class="item_image" src="{{ \Storage::url($item->image) }}">
                                </a>
                            </div>
                            <div class="item_body_name d-flex justify-content-center">
                                商品名: {{ $item->name }} 
                            </div>
                            <div class="item_body_price d-flex justify-content-center">
                                価格: {{ $item->price }} 円
                            </div>
                        </div>
                    @empty
                        <p class="col-12 ml-2 mt-5 mb-5">赤リボンの付いた商品はありません。</p>
                    @endforelse
                </div>
                @if($red_items->count()>0)
                    <div class="row">
                        <button class="col-3 mb-2 mt-2 ml-4 col-md-2 btn btn-secondary text-light submit_button">空にする</button>
                        <a href="{{ route('ribbons.red') }}" class="col-3 col-md-2 ml-auto mt-2 mr-4 mb-2 btn btn-danger">もっと見る</a>
                        <form method="post" action="{{ route('ribbons.destroy_red') }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                @endif
            </div>
        </div>
        <div id="contents2" class="tab-pane">
            <div class="border border-primary mb-3">
                <div class="row">
                    @forelse($blue_items as $item)
                        <div class="col-4">
                            <div class="ribbon_item_image">
                                <a class="ribbon_item_link d-flex align-items-center justify-content-center" href="{{ route('items.show', $item) }}">
                                    <img class="item_image" src="{{ \Storage::url($item->image) }}">
                                </a>
                            </div>
                            <div class="item_body_name d-flex justify-content-center">
                                商品名: {{ $item->name }} 
                            </div>
                            <div class="item_body_price d-flex justify-content-center">
                                価格: {{ $item->price }} 円
                            </div>
                        </div>
                    @empty
                        <p class="col-12 ml-2 mt-5 mb-5">青リボンの付いた商品はありません。</p>
                    @endforelse
                </div>
                @if($blue_items->count()>0)
                    <div class="row">
                        <button class="col-3 mb-2 mt-2 ml-4 col-md-2 btn btn-secondary text-light submit_button">空にする</button>
                        <a href="{{ route('ribbons.blue') }}" class="col-3 col-md-2 ml-auto mt-2 mr-4 mb-2 btn btn-primary">もっと見る</a>
                        <form method="post" action="{{ route('ribbons.destroy_blue') }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                @endif
            </div>
        </div>
        <div id="contents3" class="tab-pane">
            <div class="border border-success mb-3">
                <div class="row">
                    @forelse($green_items as $item)
                        <div class="col-4">
                            <div class="ribbon_item_image">
                                <a class="ribbon_item_link d-flex align-items-center justify-content-center" href="{{ route('items.show', $item) }}">
                                    <img class="item_image" src="{{ \Storage::url($item->image) }}">
                                </a>
                            </div>
                            <div class="item_body_name d-flex justify-content-center">
                                商品名: {{ $item->name }} 
                            </div>
                            <div class="item_body_price d-flex justify-content-center">
                                価格: {{ $item->price }} 円
                            </div>
                        </div>
                    @empty
                        <p class="col-12 ml-2 mt-5 mb-5">緑リボンの付いた商品はありません。</p>
                    @endforelse
                </div>
                @if($green_items->count()>0)
                    <div class="row">
                        <button class="col-3 mb-2 mt-2 ml-4 col-md-2 btn btn-secondary text-light submit_button">空にする</button>
                        <a href="{{ route('ribbons.green') }}" class="col-3 col-md-2 ml-auto mt-2 mr-4 mb-2 btn btn-success">もっと見る</a>
                        <form method="post" action="{{ route('ribbons.destroy_green') }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>


<script>
    const submit_buttons = document.querySelectorAll('.submit_button');
    submit_buttons.forEach(submit_button => {
        submit_button.addEventListener('click', e => {
            event.currentTarget.parentNode.lastElementChild.submit();
        });
    });
</script>
@endsection