<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ProfileImageRequest;
use App\Services\FileUploadService;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function edit()
    {
        return view('profile.edit', [
            'title' => 'プロフィール編集',
            'user' => \Auth::user(),
        ]);
    }
    
    public function edit_image()
    {
        return view('profile.edit_image', [
            'title' => 'プロフィール画像編集',
            'user' => \Auth::user(),
        ]);
    }
    
    public function update(ProfileRequest $request)
    {
        $user = \Auth::user();
        $profile = $request->profile ?? '';
        $user->update([
            'name' => $request->name,
            'profile' => $profile,
        ]);
        
        session()->flash('success', 'プロフィールを変更しました');
        
        return redirect()->route('users.show', $user);
    }
    
    public function update_image(ProfileImageRequest $request, FileUploadService $service)
    {
        $user = \Auth::user();
        $path = $service->saveImage($request->file('image'));
        
        $user->update([
            'image' => $path,
        ]);
        
        session()->flash('success', 'プロフィール画像を変更しました');
        
        return redirect()->route('users.show', $user);
    }
}
