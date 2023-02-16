<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Sistem",
            "surname" => "Yöneticisi",
            "email" => "sistem@gmail.com",
            "password" => "Fikret-1234",
            "email_verified_at" => now()
        ]);

        User::create([
            "name" => "Fikret",
            "surname" => "Cüre",
            "email" => "fikretcure@gmail.com",
            "password" => "Fikret-1234",
            "email_verified_at" => now()
        ]);

        User::create([
            "name" => "Semiha",
            "surname" => "Cüre",
            "email" => "semihacure@gmail.com",
            "password" => "Fikret-1234",
            "email_verified_at" => now()
        ]);
    }
}
