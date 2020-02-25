<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getTags(){
        $tags = Tag::all();
        return response()->json($tags);
    }
}
