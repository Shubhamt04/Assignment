<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'TestUser1',
               'email'=>'testuser1@test.com',
               'password'=> bcrypt('qwerty1'),
            ],
            [
               'name'=>'TestUser2',
               'email'=>'testuser2@test.com',
               'password'=> bcrypt('qwerty2'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
