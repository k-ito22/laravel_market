<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\RedRibbon;
use App\BlueRibbon;
use App\GreenRibbon;

class RibbonController extends Controller
{
    public function red()
    {
        $items = \Auth::user()->redRibbonItems;
        return view('ribbons.red', [
            'title' => '赤リボン',
            'items' => $items,
        ]);
    }
    
    public function blue()
    {
        $items = \Auth::user()->blueRibbonItems;
        return view('ribbons.blue', [
            'title' => '青リボン',
            'items' => $items,
        ]);
    }
    
    public function green()
    {
        $items = \Auth::user()->greenRibbonItems;
        return view('ribbons.green', [
            'title' => '緑リボン',
            'items' => $items,
        ]);
    }
    
    public function toggle_red(Request $request)
    {
        $id = $request->item_id;
        $item = Item::find($id);
        $user = \Auth::user();
        
        if($item->isTaggedRedBy($user)) {
            $item->redRibbons()->where('user_id', $user->id)->first()->delete();
            session()->flash('success', '赤リボンを外しました');
        } else {
            RedRibbon::create([
                'user_id' => \Auth::id(),
                'item_id' => $id,
            ]);
            session()->flash('success', '赤リボンを付けました');
        }
        
        return redirect()->route('items.index');
    }
    
    public function toggle_blue(Request $request)
    {
        $id = $request->item_id;
        $item = Item::find($id);
        $user = \Auth::user();
        
        if($item->isTaggedBlueBy($user)) {
            $item->blueRibbons()->where('user_id', $user->id)->first()->delete();
            session()->flash('success', '青リボンを外しました');
        } else {
            BlueRibbon::create([
                'user_id' => \Auth::id(),
                'item_id' => $id,
            ]);
            session()->flash('success', '青リボンを付けました');
        }
        
        return redirect()->route('items.index');
    }
    
    public function toggle_green(Request $request)
    {
        $id = $request->item_id;
        $item = Item::find($id);
        $user = \Auth::user();
        
        if($item->isTaggedGreenBy($user)) {
            $item->greenRibbons()->where('user_id', $user->id)->first()->delete();
            session()->flash('success', '緑リボンを外しました');
        } else {
            GreenRibbon::create([
                'user_id' => \Auth::id(),
                'item_id' => $id,
            ]);
            session()->flash('success', '緑リボンを付けました');
        }
        
        return redirect()->route('items.index');
    }
    
    public function destroy_red()
    {
        \Auth::user()->redRibbons()->delete();
        
        return redirect()->route('items.index');
    }
    
    public function destroy_blue()
    {
        \Auth::user()->blueRibbons()->delete();
        
        return redirect()->route('items.index');
    }
    
    public function destroy_green()
    {
        \Auth::user()->greenRibbons()->delete();
        
        return redirect()->route('items.index');
    }
    
}
