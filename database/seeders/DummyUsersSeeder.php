<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /** 
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [   
                'name'=>'TJ Trans',
                'email'=>'tjtranstravel@gmail.com',
                'role'=>'admin',
                'email_verified_at'=> now(),
                'password'=>bcrypt('admin123456'),
            
            ]

            ];

            foreach($userData as $key => $val){
                User::create($val);
            }
    }
}