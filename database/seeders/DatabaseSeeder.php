<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(['id' => 1],[
            'first_name' => 'Emmanuel',
            'last_name' => 'Adegboye',
            'email' => 'emma@test.com',
            'phone' => '08123415604',
            'password' => '12345678'
        ]);
        Customer::create([
            'first_name' => 'Emmanuel',
            'last_name' => 'Adegboye',
            'email' => 'emma@test.com',
            'phone' => '08123415604',
            'password' => Hash::make('12345678')
        ]);

        $this->call(ProductSeeder::class);
    }
}
