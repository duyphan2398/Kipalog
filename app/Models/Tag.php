<?php

namespace App\Models;

use App\Traits\StripTags;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use StripTags;
    protected $fillable = [
        'name'
    ];

    public function posts(){
        return $this->belongsToMany(Post::class,'posts_tags');
    }
}
