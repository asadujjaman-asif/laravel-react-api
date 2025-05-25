<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*User::factory()->create([
            'first_name' => 'Asif',
            'last_name' => 'Islam',
            'phone' => '01641585748',
            'address' => 'Dhaka Bangladesh',
            'email' => 'test@example.com',
        ]);*/
        $this->call([
        ProductSeeder::class,
    ]);
    }
}
