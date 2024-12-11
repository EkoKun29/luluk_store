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
            'name' => 'tokowinong'
        ]);

        Role::create([
            'name' => 'tokogabus'
        ]);

        $admin = User::query()->create([
            'name' => 'admin',
            'code' => 'A',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        $admin->assignRole('admin');

        $user = User::query()->create([
            'name' => 'tokowinong',
            'code' => 'W',
            'email' => 'tokowinong@gmail.com',
            'password' => Hash::make('winong123')
        ]);

        $user->assignRole('user');

        $user = User::query()->create([
            'name' => 'tokogabus',
            'code' => 'G',
            'email' => 'tokogabus@gmail.com',
            'password' => Hash::make('gabus456')
        ]);

        $user->assignRole('user');
    }
}
