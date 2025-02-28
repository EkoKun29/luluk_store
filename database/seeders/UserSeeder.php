<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'admin'
        ]);

        Role::create([
            'name' => 'user'
        ]);


        $admin = User::query()->create([
            'name' => 'admin',
            'code' => 'A',
            'email' => 'adminwinong@gmail.com',
            'password' => Hash::make('123456')
        ]);

        $admin->assignRole('admin');

        $user = User::query()->create([
            'name' => 'User',
            'code' => 'U',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123456')
        ]);

        $user->assignRole('user');
    }
}
