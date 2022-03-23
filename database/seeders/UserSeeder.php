<?php

namespace Database\Seeders;

use App\Models\User;
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
         User::Create([
            'first_name'=>'admin',
            'email'=>'admin@qasim.com',
            'password'=>bcrypt('123456'),
            'role_id'=> 1
        ]);
        User::Create([
            'first_name'=>'User',
            'email'=>'User@qasim.com',
            'password'=>bcrypt('123456'),
            'role_id'=> 2
        ]);
    }
}
