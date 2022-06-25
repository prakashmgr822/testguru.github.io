<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $user = new SuperAdmin([
            'name' => 'Super Admin',
            'email' => 'sa@testguru.com',
            'email_verified_at' => '2022-01-01',
            'password' => bcrypt('12345678'),
        ]);
        $user->save();

        $user = new Admin([
            'name' => 'Admin',
            'email' => 'admin@testguru.com',
            'email_verified_at' => '2022-01-01',
            'password' => bcrypt('12345678'),
        ]);
        $user->save();

        $user = new User([
            'name' => 'Student',
            'email' => 'student@testguru.com',
            'email_verified_at' => '2022-01-01',
            'password' => bcrypt('12345678'),
        ]);
        $user->save();
    }
}
