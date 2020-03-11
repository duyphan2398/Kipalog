<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;
class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagsName = ['PHP', 'LARAVEL', 'JAVASCRIPT', 'MATHLAB', 'PYTHON', 'CSS', 'HTML'];
        foreach ( $tagsName as $tagName){
            Tag::create([
               'name' => $tagName,
                'is_category' => random_int(0,1)
            ]);
        }
    }
}
