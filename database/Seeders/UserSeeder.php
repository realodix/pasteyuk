<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        DB::table('users')->insert([
            'username'       => 'admin',
            'name'           => 'Admin',
            'email'          => 'admin@admin.com',
            'password'       => Hash::make('admin'),
            'remember_token' => '1EuDF59xgwO4YZ7Vau0KkeAx1p0k7GkkGuOl6o0xhtwa24HX0PBq3yClOBd6',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
    }
}
