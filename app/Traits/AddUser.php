<?php

namespace App\Traits;

use App\User;

trait AddUser{

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function setUserIdAttribute($user_id){
        $this->attributes['user_id'] = $user_id;
    }
}
