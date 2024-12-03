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

        $data = [
            [
                "name" => "Admin User",
                "email" => "admin@doli.com",
                "role" => "System Administrator",
                "phone" => "+1 (654) 222-4387",
                "password" => "11223344",
            ],
            [
                "name" => "Manager User",
                "email" => "manager@doli.com",
                "role" => "Manager",
                "phone" => "+1 (654) 222-4387",
                "password" => "11223344"
            ],
            [
                "name" => "Clerk User",
                "email" => "clerk@doli.com",
                "role" => "Clerk",
                "phone" => "+1 (654) 222-4387",
                "password" => "11223344"
            ],
            [
                "name" => "Accountant User",
                "email" => "accountant@doli.com",
                "role" => "Accountant",
                "phone" => "+1 (654) 222-4387",
                "password" => "11223344"
            ],
            [
                "name" => "Paralegal User",
                "email" => "paralegal@doli.com",
                "role" => "Paralegal",
                "phone" => "+1 (654) 222-4387",
                "password" => "11223344"
            ],
            
        ];
          

        foreach($data as $dt){
            User::factory()->create([
                "name" => $dt['name'],
                "email" => $dt['email'],
                "role" => $dt['role'],
                "phone" => $dt['phone'],
                "password" => $dt['password'],
            ]);
        }

    }
}
