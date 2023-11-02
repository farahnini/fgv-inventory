<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use \App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => '1',
            'name' => 'Admin',
            'email' => 'admin@fgvholdings.com',
            'password' => bcrypt('test123'),
            'role' => 'Admin',
        ]);

        User::create([
            'id' => '2',
            'name' => 'Staff',
            'email' => 'staff@fgvholdings.com',
            'password' => bcrypt('test123'),
            'role' => 'Staff',
        ]);
    }
}
