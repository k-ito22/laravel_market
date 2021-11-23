<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'description', 'category_id', 'user_id', 'price', 'image'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    public function likedUsers()
    {
        return $this->belongsToMany(User::class, 'likes');
    }
    
    public function isLikedBy($user)
    {
        $liked_users_ids = $this->likedUsers->pluck('id');
        $result = $liked_users_ids->contains($user->id);
        return $result;
    }
    
    public function likeCount()
    {
        return $this->likes->count();
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    public function redRibbons()
    {
        return $this->hasMany(RedRibbon::class);
    }
    
    public function taggedRedUsers()
    {
        return $this->belongsToMany(User::class, 'red_ribbons');
    }
    
    public function isTaggedRedBy($user)
    {
        $tagged_users_ids = $this->taggedRedUsers->pluck('id');
        $result = $tagged_users_ids->contains($user->id);
        return $result;
    }
    
    public function blueRibbons()
    {
        return $this->hasMany(BlueRibbon::class);
    }
    
    public function taggedBlueUsers()
    {
        return $this->belongsToMany(User::class, 'blue_ribbons');
    }
    
    public function isTaggedBlueBy($user)
    {
        $tagged_users_ids = $this->taggedBlueUsers->pluck('id');
        $result = $tagged_users_ids->contains($user->id);
        return $result;
    }
    
    public function greenRibbons()
    {
        return $this->hasMany(GreenRibbon::class);
    }
    
    public function taggedGreenUsers()
    {
        return $this->belongsToMany(User::class, 'green_ribbons');
    }
    
    public function isTaggedGreenBy($user)
    {
        $tagged_users_ids = $this->taggedGreenUsers->pluck('id');
        $result = $tagged_users_ids->contains($user->id);
        return $result;
    }
    
    
    
}
