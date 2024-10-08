<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $user = User::factory()->create([
            'name'=> 'Nome tal'
        ]);
        Post::factory(5)->create([
            //associar o ID DO USER ao post
            'user_id'=> $user->id
        ]);


        



       /* $user = User::factory()->create();
        $food = Category::create([
            'name' => 'Food',
            'slug' => 'food-slug'
        ]);
        $scientific = Category::create([
            'name' => 'Scientifc',
            'slug' => 'scientific-slug'
        ]);

        Post::create([
            'user_id'=> $user->id,
            'category_id'=> $food->id, 
            'title' => 'Cherry Cake',
            'slug'=>'cherry-cake-slug',
            'body'=> 'Cake bla bla bla bla...',
            

        ]);


        Post::create([
            'user_id'=> $user->id,
            'category_id'=> $scientific->id, 
            'title' => 'A study about the covid',
            'slug'=>'codivd-slug',
            'body'=> 'study bla bla bla bla...',
            

        ]);*/

       
    }
}
