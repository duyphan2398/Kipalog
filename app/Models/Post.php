<?php

namespace App\Models;

use App\Traits\AddUser;
use App\Traits\ParseCreatedAt;
use App\Traits\StripTags;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use AddUser;
    use StripTags;
    use ParseCreatedAt;
    protected $fillable = [
        'title', 'content', 'user_id', 'state'
    ];

    public function getCreatedAtAttribute($created_at){
        return Carbon::parse($created_at)->format('H:i d-m-Y');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class,'posts_tags');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
}
