<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder {

    public function run() {
        DB::table('groups')->delete();

        $groups = array(
            ['id' => 1, 'name' => 'admin'],
            ['id' => 2, 'name' => 'Group 1'],
            ['id' => 3, 'name' => 'Group 2'],
            ['id' => 4, 'name' => 'Group 3'],
        );

        // Uncomment the below to run the seeder
        DB::table('groups')->insert($groups);
    }

}
