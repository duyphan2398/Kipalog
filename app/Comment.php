<?php

namespace App;

use App\Traits\AddUser;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use AddUser;
    protected $fillable = [
        'content',
        'user_id',
        'post_id'
    ];

    public function user(){
        $this->belongsTo(User::class, 'user_id');
    }

    public function post(){
        $this->belongsTo(User::class, 'post_id');
    }
}
