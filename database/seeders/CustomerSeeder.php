<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::query()->updateOrCreate(
            ['email' => 'customer@gmail.com'],
            ['email' => 'customer@gmail.com',
             'name' => 'Customer',
             'phone' => '+380123456789',
            ]
        );
    }
}
