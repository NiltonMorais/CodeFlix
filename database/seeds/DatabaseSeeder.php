<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
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
        \File::deleteDirectory($rootPath);

        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(SeriesTableSeeder::class);
        $this->call(VideosTableSeeder::class);
        $this->call(PaypalWebProfilesTableSeeder::class);
        $this->call(PlansTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(SubscriptionsTableSeeder::class);
    }
}
