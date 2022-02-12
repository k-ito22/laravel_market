@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<h1>{{ $title }}</h1>
<ul class="items row list-unstyled">
    @forelse($items as $item)
        <li class="col-lg-4 col-sm-6 col-12 mb-5">
            <div class="item card">
                <div class="item_header">
                    出品者:
                    <a href="{{ route('users.show', $item->user) }}">
                        {{ $item->user->name }}
                    </a><br>
                    ({{ $item->created_at }})
                </div>
                <div class="item_body">
                    <div class="item_body_img d-flex align-items-center justify-content-center">
                        <a href="{{ route('items.show', $item) }}">
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
                    <div>
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
<script>
    const submit_buttons = document.querySelectorAll('.submit_button');
    submit_buttons.forEach(submit_button => {
        submit_button.addEventListener('click', e => {
            event.currentTarget.parentNode.lastElementChild.submit();
        });
    });
</script>
@endsection