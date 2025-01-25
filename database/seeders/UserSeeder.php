<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "id" => "9e0c9155-f49f-48dd-9e45-ce5fc413db49",
            "name" => "Bob",
            "email" => "bob@gmail.com",
            "age" => 12,
        ]);
    }
}
