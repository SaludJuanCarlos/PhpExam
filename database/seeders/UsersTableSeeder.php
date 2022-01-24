<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Juan Carlos',
            'email' => 'jcsalud123@gmail.com',
            'password' => bcrypt('adminadmin'),
        ]);
    }
}
