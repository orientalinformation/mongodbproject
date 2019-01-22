<?php

use Illuminate\Database\Seeder;
use App\Model\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleSuperAdmin = new Role();
        $roleSuperAdmin->name = 'super.admin';
        $roleSuperAdmin->display_name = 'Super Administrator';
        $roleSuperAdmin->save();

        $roleAdmin = new Role();
        $roleAdmin->name = 'admin';
        $roleAdmin->display_name = 'Administrator';
        $roleAdmin->save();

        $roleUser = new Role();
        $roleUser->name = 'user';
        $roleUser->display_name = 'User';
        $roleUser->save();
    }
}
