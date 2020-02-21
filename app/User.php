<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use  Illuminate\Support\Facades\Hash;
use App\Post;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username', 'email','avatar', 'password',
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

    public function posts(){
        return $this->hasMany(Post::class);
    }

    /*Hash password*/
    public function setPasswordAttribute($password){
        $this->attributes['password'] = Hash::make($password);
    }

    /*Insert link hình vào avatar của user*/
    public function setAvatarAttribute($link) {
        $this->attributes['avatar'] = $link;
    }



}
