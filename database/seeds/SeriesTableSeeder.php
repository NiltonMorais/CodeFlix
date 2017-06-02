<?php

use Illuminate\Database\Seeder;

class SeriesTableSeeder extends Seeder
{
    use \CodeFlix\Media\ThumbsData;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * @var \Illuminate\Database\Eloquent\Collection $series
         */
        $series = factory(\CodeFlix\Models\Serie::class,5)->create();
        $repository = app(\CodeFlix\Repositories\Interfaces\SerieRepository::class);
        $collectionThumbs = $this->getThumbs();
        $series->each(function($serie)use($repository, $collectionThumbs){
            $repository->uploadThumb($serie,$collectionThumbs->random());
        });
    }
}
