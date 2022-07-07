<?php

use App\Post;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ( $i=0; $i < 20; $i++) { 
            $post = new Post();
            $post->title = $faker->sentence();
            $post->content = $faker->paragraph(rand(5, 20), false);
            // in questo modo già alla creazione fai il controllo che lo slug sia univoco
            $post->slug = Post::generateUniqueSlug($post->title);
            $post->save();
        }
    }
}
