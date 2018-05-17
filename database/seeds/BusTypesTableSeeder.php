<?php

use Illuminate\Database\Seeder;

class BusTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bus_types')->truncate();
        $rolesData = ["Non A/C Semi Sleeper", "Non A/C Sleeper", "A/C Semi Sleeper",
                      "A/C Sleeper", "Volvo", "Volvo AC"];
        foreach ($rolesData as $name) {
            DB::table('bus_types')->insert([
                'name'       => $name,
                'created_at' => date("Y-m-d h:i:s"),
                'updated_at' => date("Y-m-d h:i:s"),
            ]);
        }
    }
}
