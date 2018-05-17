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
        $usertData = [["bus_type_id" => 1, "name" => "SETC1101", "station_wait_time_mins" => 2],
                      ["bus_type_id" => 2, "name" => "SETC1512", "station_wait_time_mins" => 2],
                      ["bus_type_id" => 4, "name" => "Vivegam Travels", "station_wait_time_mins" => 5],
                      ["bus_type_id" => 6, "name" => "Royal Travels", "station_wait_time_mins" => 10]];
        foreach ($usertData as $data) {
            DB::table('buses')->insert([
                'bus_type_id'    => $data['bus_type_id'],
                'name'       => $data['name'],
                'station_wait_time_mins'      => $data['station_wait_time_mins'],
                'created_at' => date("Y-m-d h:i:s"),
                'updated_at' => date("Y-m-d h:i:s"),
            ]);
        }
    }
}
