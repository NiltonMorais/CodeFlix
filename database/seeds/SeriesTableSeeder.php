<?php

use Illuminate\Database\Seeder;

class SeriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $disk = config('filesystems.default');
        $rootPath = config("filesystems.disks.{$disk}.root");
        \File::deleteDirectory("{$rootPath}/series");

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

    protected function getThumbs()
    {
        return new \Illuminate\Support\Collection([
           new \Illuminate\Http\UploadedFile(
               storage_path('app/files/faker/thumbs/teste.jpg'),
               'teste.jpg'
           ),
        ]);
    }
}
