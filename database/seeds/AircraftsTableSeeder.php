<?php

use Illuminate\Database\Seeder;

class AircraftsTableSeeder extends Seeder {

    public function run() {
        // Uncomment the below to wipe the table clean before populating
        DB::table('aircrafts')->delete();

        $aircrafts = array(
            ['id' => 1, 'model' => 'Cessna 172N', 'year' => 1979, 'fleet_list_id' => 1, 'user_id' => 2],
            ['id' => 2, 'name' => 'Piper PA-28', 'year' => 1975, 'fleet_list_id' => 1, 'user_id' => 3],
            ['id' => 3, 'model' => 'Grumman AA1-B', 'year' => 1976, 'fleet_list_id' => 2, 'user_id' => 5],
            ['id' => 4, 'name' => 'Cherokee 180', 'year' => 1963, 'fleet_list_id' => 2, 'user_id' => 5],
        );

        // Uncomment the below to run the seeder
        DB::table('aircrafts')->insert($aircrafts);
    }

}
