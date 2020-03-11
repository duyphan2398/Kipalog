<?php

namespace App\Models;

use App\Traits\StripTags;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use StripTags;
    protected $fillable = [
        'name','id_category'
    ];

    protected $attributes = [
        'is_category' => 0
    ];

    public function posts(){
        return $this->belongsToMany(Post::class,'posts_tags');
    }

    public function isCategory(){
        return ($this->is_category == 1) ? true : false ;
    }

    public function changeIsCategory(){
        ($this->is_category == 1) ? ($this->is_category = 0) :  ($this->is_category = 1);
    }
}
