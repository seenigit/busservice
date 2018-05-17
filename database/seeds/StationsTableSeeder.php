<?php

use Illuminate\Database\Seeder;

class StationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stations')->truncate();
        $usertData = [["name" => "Thoothukudi", "address" => "Melur Nagar, Shanmugapuram"],
                      ["name" => "Spic", "address" => "Melur Nagar, Shanmugapuram"],
                      ["name" => "Pudhukotai", "address" => "Melur Nagar, Shanmugapuram"],
                      ["name" => "eral", "address" => "Melur Nagar, Shanmugapuram"],
                      ["name" => "Virudhunagar", "address" => "Melur Nagar, Shanmugapuram"],
                      ["name" => "Madurai periyar bus stand", "address" => "Melur Nagar, Shanmugapuram"],
                      ["name" => "Madurai matuthaveni bus stand", "address" => "Melur Nagar, Shanmugapuram"],
                      ["name" => "Manamadurai", "address" => "Melur Nagar, Shanmugapuram"],
                      ["name" => "Vallanadu", "address" => "Melur Nagar, Shanmugapuram"],
                      ["name" => "Thirunelveli", "address" => "Melur Nagar, Shanmugapuram"]];
        foreach ($usertData as $data) {
            DB::table('stations')->insert([
                'name'    => $data['name'],
                'address'       => $data['address'],
                'created_at' => date("Y-m-d h:i:s"),
                'updated_at' => date("Y-m-d h:i:s"),
            ]);
        }
    }
}
