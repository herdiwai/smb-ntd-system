<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //Admin
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'admin',
                'status' => 'active',
            ],
            //NTD
            [
                'name' => 'Ntd',
                'username' => 'ntd',
                'email' => 'ntd@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'ntd',
                'status' => 'active',
            ],
            //Production
            [
                'name' => 'Production',
                'username' => 'production',
                'email' => 'production@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'production',
                'status' => 'active',
            ],
            //QC
            [
                'name' => 'Qc',
                'username' => 'qc',
                'email' => 'qc@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'qc',
                'status' => 'active',
            ],
            //Facility
            [
                'name' => 'Facility',
                'username' => 'facility',
                'email' => 'facility@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'facility',
                'status' => 'active',
            ],
            //User
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'user',
                'status' => 'active',
            ],
        ]);
    }
}
