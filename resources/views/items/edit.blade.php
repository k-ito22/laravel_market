@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<h1>{{ $title }}</h1>
<form method="POST" action="{{ route('items.update', $item) }}" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
      <div>
          <label>
            商品名:
            <input type="text" name="name" value="{{ old('name', $item->name) }}">
          </label>
      </div>
      <div>
          <label>
            商品説明:
            <textarea name="description">{{ old('description', $item->description) }}</textarea>
          </label>
      </div>
      <div>
          <label>
            価格:
            <input type="number" name="price" value="{{ old('price', $item->price) }}">
          </label>
      </div>
      <div>
          <label>
            カテゴリー:
            <select name="category_id">
                @foreach($categories as $category)
                    @if((int)old('category_id', $item->category_id) === $category->id)
                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                    @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                @endforeach
            </select>
          </label>
      </div>
 
      <input type="submit" value="出品">
  </form>
@endsection