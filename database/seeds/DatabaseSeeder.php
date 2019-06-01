<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        DB::table('posts')->truncate();
        DB::table('categories')->truncate();
        DB::table('tags')->truncate();

        factory(App\User::class,10)->create();
        $users = App\User::all();
        factory(App\Post::class,20)->make()->each(function($post)use($users){
            // dd($users->random()->id);
            $post->user_id = $users->random()->id;
            $post->save();
        });
        factory(App\Tag::class,10)->create();
        $tags = App\Tag::all();
        App\Post::all()->each(function($post)use($tags){
            $post->tags()->sync($tags->random(rand(1,3))->pluck('id')->toArray());
        });
    }
}
