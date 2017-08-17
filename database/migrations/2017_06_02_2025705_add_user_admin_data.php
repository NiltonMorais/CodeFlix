<?php

use CodeFlix\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserAdminData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $model = User::create([
            'name' => env('ADMIN_DEFAULT_NAME','Admin Silva'),
            'email' => env('ADMIN_DEFAULT_EMAIL','admin@user.com'),
            'password' => bcrypt(env('ADMIN_DEFAULT_PASSWORD','secret')),
            'role' => User::ROLE_ADMIN,
        ]);

        $model->verified = true;
        $model->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $user = User::where('email','=',env('ADMIN_DEFAULT_EMAIL','admin@user.com'))->first();
        if($user instanceof User){
            $user->delete();
        }
    }
}
