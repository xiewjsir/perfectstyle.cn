<?php

use Illuminate\Database\Seeder;
use App\Models\AdminRole;

class AdministratorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        * 获取角色表里超级管理员的数据
        */
        $adminRole = AdminRole::where('name','admin')->first();
        /*
        * 获取角色表里普通管理员的数据
        */
        $userRole = AdminRole::where('name','user')->first();
        $admin = factory('App\AdminUser')->create([
            'name' => 'admin123',
            'username' => 'admin123',
            'email' => '183@qq.com',
            'password' => bcrypt('123456')
        ])->each(function($u) use ($adminRole)
        {
            $u->attachRole($adminRole);
        });

        $users = factory('App\AdminUser', 3)->create([
            'password' => bcrypt('123456')
        ])->each(function($u) use ($userRole){
            $u->roles()->attach($userRole->id);
        });
    }
}
