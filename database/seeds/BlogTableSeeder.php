<?php

use App\Models\Blog;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogTableSeeder extends Seeder
{

    public function run()
    {

        for ($i=1; $i <= 30; $i++) {
             Blog::create([
                'title' => 'blogs '.$i,
                'slug' => 'blogs-'.$i,
                'desc' =>'Lorem '. $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
                'img' => 'blogs/dummy/normal_spongebob.jpg',
                'user_id' => 1,
            ])->tags()->sync([1]);
       }

    }

}
