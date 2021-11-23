<?php

namespace App\Http\Controllers;

use App\Item;
use App\Category;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\ItemEditRequest;
use App\Http\Requests\ItemImageRequest;
use App\Services\FileUploadService;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $items = Item::where('user_id', '<>', \Auth::id())->latest()->limit(6)->get();
        $red_items = \Auth::user()->redRibbonItems()
            ->withPivot('created_at AS red_ribbon_created_at')
            ->orderBy('red_ribbon_created_at', 'desc')
            ->limit(3)
            ->get();
        $blue_items = \Auth::user()->blueRibbonItems()
            ->withPivot('created_at AS blue_ribbon_created_at')
            ->orderBy('blue_ribbon_created_at', 'desc')
            ->limit(3)
            ->get();
        $green_items = \Auth::user()->greenRibbonItems()
            ->withPivot('created_at AS green_ribbon_created_at')
            ->orderBy('green_ribbon_created_at', 'desc')
            ->limit(3)
            ->get();
        return view('items.index', [
            'title' => 'トップページ',
            'items' => $items,
            'red_items' => $red_items,
            'blue_items' => $blue_items,
            'green_items' => $green_items,
        ]);
    }

    public function create()
    {
        
        $categories = Category::get();
        return view('items.create', [
            'title' => '新規出品',
            'categories' => $categories,
        ]);
    }

    public function store(ItemRequest $request, FileUploadService $service)
    {
        $path = $service->saveImage($request->file('image'));
        
        if($path) {
            Item::create([
                'user_id' => \Auth::id(),
                'name' => $request->name,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'image' => $path,
            ]);
            session()->flash('succsess', '新規商品を登録しました');
        } else {
            session()->flash('error', '新規商品の登録に失敗しました');
        }
        return redirect()->route('items.index');
    }

    public function show(Item $item)
    {
        return view('items.show', [
            'title' => '商品詳細',
            'item' => $item,
        ]);
    }

    public function edit(Item $item)
    {
        $categories = Category::get();
        return view('items.edit', [
            'title' => '商品情報編集',
            'item' => $item,
            'categories' => $categories,
        ]);
    }

    public function update(ItemEditRequest $request, Item $item)
    {
        $user = \Auth::user();
        $item->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);
        
        return redirect()->route('users.exhibitions', $user);
    }
    
    public function edit_image(Item $item)
    {
        return view('items.edit_image', [
            'title' => '商品画像の変更',
            'item' => $item,
        ]);
    }
    
    public function update_image(ItemImageRequest $request, Item $item, FileUploadService $service)
    {
        $user = \Auth::user();
        $path = $service->saveImage($request->file('image'));
        $item->update([
            'image' => $path,
        ]);
        return redirect()->route('users.exhibitions', $user);
    }

    public function destroy(Item $item)
    {
        $user = \Auth::user();
        $item->delete();
        
        session()->flash('success', '商品を削除しました');
        return redirect()->route('users.exhibitions', $user);
    }
    
    public function confirm(Item $item)
    {
        return view('items.confirm', [
            'title' => '購入確認',
            'item' => $item,
        ]);
    }
    
    public function finish(Item $item)
    {
        if($item->orders()->count() > 0) {
            session()->flash('error', 'この商品は在庫がありません');
            return redirect()->route('items.show', $item);
        } else {
            Order::create([
                'item_id' => $item->id,
                'user_id' => \Auth::id(),
            ]);
            
            return view('items.finish', [
                'title' => '購入ありがとうございました',
                'item' => $item,
            ]);
        }
    }
    
    public function display()
    {
        $items = Item::where('user_id', '<>', \Auth::id())->latest()->get();
        return view('items.display', [
            'title' => '商品一覧',
            'items' => $items,
        ]);
    }
}
