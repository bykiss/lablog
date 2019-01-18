<?php

use Illuminate\Database\Seeder;

class UserTablSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //创建10个
        $users = factory(\App\Models\User::class)->times(10)->make();
        \App\Models\User::insert($users->makeVisible(['password','remember_token'])->toArray());
        $user = \App\Models\User::find(1);
        $user->name = 'test';
        $user->email = 'test@qq.com';
        $user->password = bcrypt('123456');
        $user->is_admin = true;
        $user->save();

    }
}
