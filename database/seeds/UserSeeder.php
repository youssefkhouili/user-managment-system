<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'John Doe',
            'email'     => 'john@doe.com',
            'role'      => 'admin',
            'password'  => bcrypt('yahya1235')
        ]);
    }
}
