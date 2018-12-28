<?php

use Illuminate\Database\Seeder;
use App\Models\AdminPermission;
use App\Models\AdminRole;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin               = new AdminRole;
        $admin->name         = 'admin';
        $admin->display_name = '超级管理员';
        $admin->description  = '超级管理员';
        $admin->save();
        $owner               = new AdminRole;
        $owner->name         = 'user';
        $owner->display_name = '普通管理员';
        $owner->description  = '普通管理员';
        $owner->save();
        /*
        * 超级管理员
        */
        $allPermission = array_column(AdminPermission::all()->toArray(),'id');
        $admin->perms()->sync($allPermission);
        /*
        * 普通管理员
        */
        $createUser = AdminPermission::where('display_name','添加菜单')->first();
        $loginBackend = AdminPermission::where('name','admin.system.login')->first();
        $owner->attachPermissions([$createUser,$loginBackend]);
    }
}
