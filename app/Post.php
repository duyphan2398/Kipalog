<?php

namespace App;

use App\Traits\AddUser;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use AddUser;
    protected $fillable = [
        'title', 'content', 'user_id'
    ];

    public function tags(){
        return $this->belongsToMany(Tag::class,'posts_tags');
    }

}
