<?php

use Illuminate\Database\Seeder;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $series = \CodeFlix\Models\Serie::all();
        $categories = \CodeFlix\Models\Category::all();

        factory(\CodeFlix\Models\Video::class,100)
            ->create()
            ->each(function($video) use($series,$categories){
                $video->categories()->attach($categories->random(4)->pluck('id'));
                $num = rand(1,3);
                if($num%2==0){
                    $serie = $series->random();
                    $video->serie()->associate($serie);
                    $video->save();
                }
            });
    }
}
