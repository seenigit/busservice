<?php

use Illuminate\Database\Seeder;

class BusStationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buses_stations')->truncate();
        $usertData = [["bus_id" => 1, "station_id" => 1,
                       "station_order" => 1, 'arrival_time' => '09:00:00'],
                      ["bus_id" => 1, "station_id" => 3,
                       "station_order" => 2, 'arrival_time' => '09:30:00'],
                      ["bus_id" => 1, "station_id" => 5,
                       "station_order" => 3, 'arrival_time' => '10:30:00'],
                      ["bus_id" => 1, "station_id" => 6,
                       "station_order" => 4, 'arrival_time' => '11:30:00'],
                      ["bus_id" => 1, "station_id" => 7,
                       "station_order" => 5, 'arrival_time' => '11:45:00'],
                      ["bus_id" => 2, "station_id" => 1,
                       "station_order" => 1, 'arrival_time' => '09:00:00'],
                      ["bus_id" => 2, "station_id" => 2,
                       "station_order" => 2, 'arrival_time' => '09:20:00'],
                      ["bus_id" => 2, "station_id" => 4,
                       "station_order" => 3, 'arrival_time' => '09:45:00'],
                      ["bus_id" => 2, "station_id" => 6,
                       "station_order" => 4, 'arrival_time' => '11:15:00'],
                      ["bus_id" => 3, "station_id" => 8,
                       "station_order" => 1, 'arrival_time' => '12:00:00'],
                      ["bus_id" => 3, "station_id" => 7,
                       "station_order" => 2, 'arrival_time' => '13:00:00'],
                      ["bus_id" => 3, "station_id" => 6,
                       "station_order" => 3, 'arrival_time' => '13:15:00'],
                      ["bus_id" => 3, "station_id" => 5,
                       "station_order" => 4, 'arrival_time' => '14:15:00'],
                      ["bus_id" => 3, "station_id" => 3,
                       "station_order" => 5, 'arrival_time' => '15:15:00'],
                      ["bus_id" => 3, "station_id" => 1,
                       "station_order" => 6, 'arrival_time' => '15:45:00'],
                      ["bus_id" => 4, "station_id" => 2,
                       "station_order" => 1, 'arrival_time' => '18:00:00'],
                      ["bus_id" => 4, "station_id" => 9,
                       "station_order" => 2, 'arrival_time' => '18:35:00'],
                      ["bus_id" => 4, "station_id" => 10,
                       "station_order" => 3, 'arrival_time' => '19:15:00'],
                      ["bus_id" => 4, "station_id" => 8,
                       "station_order" => 4, 'arrival_time' => '21:00:00'],
            ];
        foreach ($usertData as $data) {
            DB::table('buses_stations')->insert([
                'bus_id'    => $data['bus_id'],
                'station_id'       => $data['station_id'],
                'station_order'   => $data['station_order'],
                'arrival_time' => $data['arrival_time'],
                'created_at' => date("Y-m-d h:i:s"),
                'updated_at' => date("Y-m-d h:i:s"),
            ]);
        }
    }
}
