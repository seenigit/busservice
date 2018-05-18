<?php

use Illuminate\Database\Seeder;

class BusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buses')->truncate();
        $usertData = [["bus_type_id" => 1, "name" => "SETC1101"],
                      ["bus_type_id" => 2, "name" => "SETC1512"],
                      ["bus_type_id" => 4, "name" => "Vivegam Travels"],
                      ["bus_type_id" => 6, "name" => "Royal Travels"]];
        foreach ($usertData as $data) {
            DB::table('buses')->insert([
                'bus_type_id'    => $data['bus_type_id'],
                'name'       => $data['name'],
                'created_at' => date("Y-m-d h:i:s"),
                'updated_at' => date("Y-m-d h:i:s"),
            ]);
        }
    }
}
