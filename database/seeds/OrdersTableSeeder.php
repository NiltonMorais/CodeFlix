<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = app(\CodeFlix\Repositories\Interfaces\UserRepository::class)->all();
        $orders = factory(\CodeFlix\Models\Order::class,30)->make();
        $orders->each(function($order)use($users){
           $order->user_id = $users->random()->id;
           $order->save();
        });
    }
}
