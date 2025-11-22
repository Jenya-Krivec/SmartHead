<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@gmail.com'],
            ['email' => 'admin@gmail.com',
             'name' => 'Admin',
             'password' => '$2y$12$/MW8kIT6UE/QC8pl/.2bBu/MK77Tb3YnRWsXRwPCqWmEABz8jxbeq',
            ]
        );

        Role::query()->create(
            ['name' => 'admin']
        );

        $admin->assignRole('admin');
    }
}
