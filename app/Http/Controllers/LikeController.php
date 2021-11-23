<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Like;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $items = \Auth::user()->likeItems()
            ->withPivot('created_at AS like_created_at')
            ->orderBy('like_created_at', 'desc')
            ->get();
        return view('likes.index', [
            'title' => 'お気に入り一覧',
            'items' => $items,
        ]);
    }
    
    public function toggle(Request $request)
    {
        $id = $request->item_id;
        $item = Item::find($id);
        $user = \Auth::user();
        
        if($item->isLikedBy($user)) {
            $item->likes()->where('user_id', $user->id)->first()->delete();
            session()->flash('success', 'いいねを消去しました');
        } else {
            Like::create([
                'user_id' => \Auth::id(),
                'item_id' => $id,
            ]);
            session()->flash('success', 'いいねしました');
        }
        
        return redirect()->route('items.index');
    }
}
