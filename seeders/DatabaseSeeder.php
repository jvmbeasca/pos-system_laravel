<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'full_name' => 'John Vincent Beasca',
            'username' => 'jvmbeasca',
            'email' => 'jmbeasca@fit.edu.ph',
            'password' => 'admin123',
        ]);
    }
}