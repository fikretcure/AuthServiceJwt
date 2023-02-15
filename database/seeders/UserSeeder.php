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
            "name" => "Fikret",
            "surname" => "Cüre",
            "email" => "fikretcure@gmail.com",
            "password" => "Fikret-1234",
            "reg_code" =>rand()
        ]);

        User::create([
            "name" => "Semiha",
            "surname" => "Cüre",
            "email" => "semihacure@gmail.com",
            "password" => "Fikret-1234",
            "reg_code" =>rand()
        ]);
    }
}
