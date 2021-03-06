<?php

use Illuminate\Database\Seeder;
use App\Model\Role;
use App\Model\User;
use App\Model\AccountManager;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', 'super.admin')->first();
        $accountManager = AccountManager::where('name', 'Club')->first();

        $user = new User();
        $user->fullname = 'Super Administrator';
        $user->username = 'admin';
        $user->password = Hash::make('password');
        $user->gender = 1;
        $user->is_admin = 1;
        $user->role_id = $role->id;
        $user->account_id = $accountManager->id;
        $user->save();
    }
}
