<?php

namespace App\Models;

use App\Models\Post;
use App\Traits\AddUser;
use App\Traits\ParseCreatedAt;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use AddUser;
    use ParseCreatedAt;
    protected $fillable = [
        'post_id',
        'user_id',
    ];

    public function post(){
        return $this->belongsTo(Post::class,'post_id');
    }


}
