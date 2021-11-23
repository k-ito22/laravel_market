@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<h1>{{ $title }}</h1>
<div>
  <span>現在の画像</span>
  <img src="{{ \Storage::url($item->image) }}">
</div>
<form method="POST" action="{{ route('items.update_image', $item) }}" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
      <div>
          <label>
            画像を選択:
            <input type="file" name="image">
          </label>
      </div>
      <input type="submit" value="更新">
  </form>
@endsection