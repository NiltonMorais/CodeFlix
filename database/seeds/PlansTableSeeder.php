<?php

use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $webProfiles = app(\CodeFlix\Repositories\Interfaces\PaypalWebProfileRepository::class)->all();

        factory(\CodeFlix\Models\Plan::class,1)->states(
            \CodeFlix\Models\Plan::DURATION_MONTHLY
        )->create([
            'paypal_web_profile_id' => $webProfiles->random()->id
        ]);

        factory(\CodeFlix\Models\Plan::class,1)->states(
            \CodeFlix\Models\Plan::DURATION_YEARLY
        )->create([
            'paypal_web_profile_id' => $webProfiles->random()->id
        ]);
    }
}
