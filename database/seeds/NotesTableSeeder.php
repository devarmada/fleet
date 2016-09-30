<?php

use Illuminate\Database\Seeder;

class NotesTableSeeder extends Seeder {

    public function run() {
        // Uncomment the below to wipe the table clean before populating
        DB::table('notes')->delete();

        $notes = array(
          ['id' => 1, 'title' => 'How nice!', 'text' => 'I really like it', 'aircraft_id' => 1, 'user_id' => 2],
          ['id' => 2, 'title' => 'I love it!', 'text' => "It's very nice", 'aircraft_id' => 1, 'user_id' => 2],
          ['id' => 3, 'title' => 'It sucks!', 'text' => "I don't like it at all", 'aircraft_id' => 1, 'user_id' => 3],
          ['id' => 4, 'title' => 'Wow!', 'text' => 'Nice one', 'aircraft_id' => 4, 'user_id' => 5],
        );

        // Uncomment the below to run the seeder
        DB::table('notes')->insert($notes);
    }

}
