@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<h1>{{ $title }}</h1>
<form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
      @csrf
      <div>
          <label>
            商品名:
            <input type="text" name="name" value="{{ old('name') }}">
          </label>
      </div>
      <div>
          <label>
            商品説明:
            <textarea name="description" value="{{ old('description') }}"></textarea>
          </label>
      </div>
      <div>
          <label>
            価格:
            <input type="number" name="price" value="{{ old('price') }}">
          </label>
      </div>
      <div>
          <label>
            カテゴリー:
            <select name="category_id">
                <option value="">選択してください</option>
                @foreach($categories as $category)
                    @if((int)old('category_id') === $category->id)
                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                    @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                @endforeach
            </select>
          </label>
      </div>
      <div>
          <label>
            画像を選択:
            <input type="file" name="image">
          </label>
      </div>
 
      <input type="submit" value="出品">
  </form>
@endsection