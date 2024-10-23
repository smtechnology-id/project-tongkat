<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'nim' => '1234567890',
            'telephone' => '081234567890',
            'email' => 'admin@tongkat.com',
            'role' => 'admin',
            'password' => Hash::make('xEYnws6y'),
        ]);
    }
}
