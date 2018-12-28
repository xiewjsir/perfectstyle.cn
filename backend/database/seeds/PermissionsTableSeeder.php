<?php

use Illuminate\Database\Seeder;
use App\Models\AdminPermission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        * 登陆权限
        */
        AdminPermission::create([
            'name' => 'admin.system.login',
            'display_name' => '登陆后台',
            'description' => '登陆后台',
        ]);
        /*
        * 菜单权限
        */
        AdminPermission::create([
            'name' => 'admin.menus.list',
            'display_name' => '菜单列表',
            'description' => '菜单列表',
        ]);
        AdminPermission::create([
            'name' => 'admin.menus.add',
            'display_name' => '添加菜单',
            'description' => '添加菜单',
        ]);
        AdminPermission::create([
            'name' => 'admin.menus.edit',
            'display_name' => '修改菜单',
            'description' => '修改菜单',
        ]);
        AdminPermission::create([
            'name' => 'admin.menus.delete',
            'display_name' => '删除菜单',
            'description' => '删除菜单',
        ]);
    }
}
