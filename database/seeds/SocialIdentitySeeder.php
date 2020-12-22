<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SocialIdentitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('social_identities')->insert([
            'user_id' => 1,
            'provider_name' => 'google',
            'provider_id' => Str::random(10),
            'auth_token' => Hash::make(Str::random(10)),
        ]);

        DB::table('social_identities')->insert([
            'user_id' => 1,
            'provider_name' => 'facebook',
            'provider_id' => Str::random(10),
            'auth_token' => Hash::make(Str::random(10)),
        ]);

        DB::table('social_identities')->insert([
            'user_id' => 1,
            'provider_name' => 'twitter',
            'provider_id' => Str::random(10),
            'auth_token' => Hash::make(Str::random(10)),
        ]);


        DB::table('social_identities')->insert([
            'user_id' => 2,
            'provider_name' => 'google',
            'provider_id' => Str::random(10),
            'auth_token' => Hash::make(Str::random(10)),
        ]);

        DB::table('social_identities')->insert([
            'user_id' => 2,
            'provider_name' => 'facebook',
            'provider_id' => Str::random(10),
            'auth_token' => Hash::make(Str::random(10)),
        ]);

        DB::table('social_identities')->insert([
            'user_id' => 2,
            'provider_name' => 'twitter',
            'provider_id' => Str::random(10),
            'auth_token' => Hash::make(Str::random(10)),
        ]);

        DB::table('social_identities')->insert([
            'user_id' => 3,
            'provider_name' => 'google',
            'provider_id' => Str::random(10),
            'auth_token' => Hash::make(Str::random(10)),
        ]);

        DB::table('social_identities')->insert([
            'user_id' => 3,
            'provider_name' => 'facebook',
            'provider_id' => Str::random(10),
            'auth_token' => Hash::make(Str::random(10)),
        ]);

        DB::table('social_identities')->insert([
            'user_id' => 3,
            'provider_name' => 'twitter',
            'provider_id' => Str::random(10),
            'auth_token' => Hash::make(Str::random(10)),
        ]);
    }
}