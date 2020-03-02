<?php

namespace App\Traits;

trait StripTags{

    public function stripTags($atributes){
        foreach ($atributes as $attribute) {
            $this->attributes[$attribute] = strip_tags($this->attributes[$attribute]);
        }
    }
}
