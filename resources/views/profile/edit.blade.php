@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  [<a href="{{ route('users.show', $user) }}">戻る</a>]
  <form method="POST" action="{{ route('profile.update') }}">
      @csrf
      @method('PATCH')
      <div>
          <label>
            名前:
            <input type="text" name="name" value="{{ $user->name }}">
          </label>
      </div>
      <div>
          <label>
            プロフィール:
            <textarea name="profile">{{ $user->profile }}</textarea>
          </label>
      </div>
      <input type="submit" value="更新">
  </form>
@endsection