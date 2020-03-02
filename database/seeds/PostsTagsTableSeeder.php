<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;
use App\Models\Post;

class PostsTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $posts = Post::all();
        foreach ($posts as $post){
            $tags = Tag::all()->random(rand(1,5));
            foreach ( $tags as $tag) {
                DB::table('posts_tags')->insert([
                    'post_id'=>$post->id,
                    'tag_id' =>$tag->id
                ]);
            }
        }
    }
}
