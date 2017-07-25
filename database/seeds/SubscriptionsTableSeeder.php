<?php

use Illuminate\Database\Seeder;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = app(\CodeFlix\Repositories\Interfaces\PlanRepository::class)->all();
        $orders = app(\CodeFlix\Repositories\Interfaces\OrderRepository::class)->all();
        $repository = app(\CodeFlix\Repositories\Interfaces\SubscriptionRepository::class);

        foreach (range(1, 20) as $i) {
            $repository->create([
                'plan_id' => $plans->random()->id,
                'order_id' => $orders->random()->id,
            ]);
        }
    }
}
