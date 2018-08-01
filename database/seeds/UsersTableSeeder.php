<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Faker\Generator as Faker;

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
            'username' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$FP6GRJ8NTlBnTes.hI8zUetrJwjGk3HEXxgvhiEMToOGoV6Fw90Jy',
            'remember_token' => '1EuDF59xgwO4YZ7Vau0KkeAx1p0k7GkkGuOl6o0xhtwa24HX0PBq3yClOBd6',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // foreach(range(0,500) as $i){
        //     DB::table('pastes')->insert([
        //         'userId' => 0,
        //         'title' => $faker->jobTitle,
        //         'content' => Crypt::encryptString($faker->realText($maxNbChars = 200, $indexSize = 2)),
        //         'link' => $faker->regexify('[a-zA-Z0-9]{8}'),
        //         'views' => 0,
        //         'ip' => $faker->localIpv4,
        //         'syntax' => 0,
        //         'expiration' => 0,
        //         'privacy' => 0,
        //         'password' => 0,
        //         'burnAfter' => 0,
        //         'created_at' => $now,
        //         'updated_at' => $now
        //     ]);
        // }
    }
}
