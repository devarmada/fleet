<?php

use Illuminate\Database\Seeder;

class FleetListsTableSeeder extends Seeder {

    public function run() {
        // Uncomment the below to wipe the table clean before populating
        DB::table('fleet_lists')->delete();

        $fleet_lists = array(
            ['id' => 1, 'name' => 'List 1', 'description' => 'Aircraft list for group #1', 
                'user_id' => '2', 'group_id' => 2],
            ['id' => 2, 'name' => 'List 2', 'description' => 'Aircraft list for group #2', 
                'user_id' => '5', 'group_id' => 3],
        );

        // Uncomment the below to run the seeder
        DB::table('fleet_lists')->insert($fleet_lists);
    }

}
