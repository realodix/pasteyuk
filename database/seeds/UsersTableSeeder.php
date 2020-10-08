<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $now = now();

        DB::table('users')->insert([
            'username'       => 'admin',
            'name'           => 'Admin',
            'email'          => 'admin@admin.com',
            'password'       => '$2y$10$FP6GRJ8NTlBnTes.hI8zUetrJwjGk3HEXxgvhiEMToOGoV6Fw90Jy',
            'remember_token' => '1EuDF59xgwO4YZ7Vau0KkeAx1p0k7GkkGuOl6o0xhtwa24HX0PBq3yClOBd6',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
    }
}
