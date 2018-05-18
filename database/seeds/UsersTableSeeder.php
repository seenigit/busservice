<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $usertData = [
            [
                "name" => "Admin", "email" => "admin@busservice.com", "role_id" => 1,
                "address" => "pc road west, millerpuram", "city" => "Tuticorin"
            ],
            [
                "name" => "Passenger One", "email" => "user1@busservice.com", "role_id" => 2,
                "address" => "pc road west, millerpuram", "city" => "Tuticorin"
            ],
            [
                "name" => "Passenger Two", "email" => "user2@busservice.com", "role_id" => 2,
                "address" => "Melakkal Main Road, Kochadai", "city" => "Madurai"
            ]
        ];
        foreach ($usertData as $data) {
            DB::table('users')->insert([
                'role_id'    => $data['role_id'],
                'name'       => $data['name'],
                'email'      => $data['email'],
                'address'      => $data['address'],
                'city'      => $data['city'],
                'password'   => app('hash')->make('password'),
                'created_at' => date("Y-m-d h:i:s"),
                'updated_at' => date("Y-m-d h:i:s"),
            ]);
        }
    }
}
