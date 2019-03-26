<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(RoleTableSeeder::class);
        $this->call(AccountManagerTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(RssTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(LibrariesTableSeeder::class);
        $this->call(BookTableSeeder::class);
        Model::reguard();
    }
}
