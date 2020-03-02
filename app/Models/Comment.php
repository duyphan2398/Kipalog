<?php

namespace App\Models;

use App\Traits\AddUser;
use App\Traits\ParseCreatedAt;
use Illuminate\Database\Eloquent\Model;
class Comment extends Model
{
    use AddUser;
    use ParseCreatedAt;
    protected $fillable = [
        'content',
        'user_id',
        'post_id'
    ];

    public function post(){
        $this->belongsTo(Post::class, 'post_id');
    }
}
