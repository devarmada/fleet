<?php

use Illuminate\Database\Seeder;

class GroupUserTableSeeder extends Seeder {

    public function run() {
        DB::table('group_user')->delete();

        $group_user = array(
            ['user_id' => 1, 'group_id' => 1],
            ['user_id' => 2, 'group_id' => 2],
            ['user_id' => 3, 'group_id' => 2],
            ['user_id' => 3, 'group_id' => 3],
            ['user_id' => 4, 'group_id' => 3],
            ['user_id' => 5, 'group_id' => 4],
        );

        // Uncomment the below to run the seeder
        DB::table('group_user')->insert($group_user);
    }

}
