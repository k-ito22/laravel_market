<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile', 'image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    public function likeItems()
    {
        return $this->belongsToMany(Item::class, 'likes');
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    public function orderItems()
    {
        return $this->belongsToMany(Item::class, 'orders');
    }
    
    public function redRibbons()
    {
        return $this->hasMany(RedRibbon::class);
    }
    
    public function redRibbonItems()
    {
        return $this->belongsToMany(Item::class, 'red_ribbons');
    }
    
    public function blueRibbons()
    {
        return $this->hasMany(BlueRibbon::class);
    }
    
    public function blueRibbonItems()
    {
        return $this->belongsToMany(Item::class, 'blue_ribbons');
    }
    
    public function greenRibbons()
    {
        return $this->hasMany(GreenRibbon::class);
    }
    
    public function greenRibbonItems()
    {
        return $this->belongsToMany(Item::class, 'green_ribbons');
    }
}
