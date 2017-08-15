<?php

use Illuminate\Database\Seeder;

class PaypalWebProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\CodeFlix\Models\PaypalWebProfile::class,20)->create();
    }
}
