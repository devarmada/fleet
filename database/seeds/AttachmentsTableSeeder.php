<?php

use Illuminate\Database\Seeder;

class AttachmentsTableSeeder extends Seeder {

    public function run() {
        // Uncomment the below to wipe the table clean before populating
        DB::table('attachments')->delete();

        $attachments = array(
          ['id' => 1, 'title' => 'my plane is nice', 'file_name' => 'Cessna172-CatalinaTakeOff.JPG', 'file_path' => 'Cessna172-CatalinaTakeOff.JPG', 'file_type' => 'image/jpeg', 'aircraft_id' => 1, 'user_id' => 2],
          ['id' => 2, 'title' => 'mine is better', 'file_name' => "cessna-172m-m0a.jpg", 'file_path' => '', 'file_type' => 'image/jpeg', 'aircraft_id' => 1, 'user_id' => 2],
          ['id' => 3, 'title' => 'no, mine!', 'file_name' => "c172r-in-flight.jpg", 'file_path' => 'c172r-in-flight.jpg', 'file_type' => 'image/jpeg', 'aircraft_id' => 1, 'user_id' => 3],
          ['id' => 4, 'title' => 'this is my plane', 'file_name' => 'n5308l_1.jpg', 'file_path' => 'n5308l_1.jpg', 'file_type' => 'image/jpeg', 'aircraft_id' => 4, 'user_id' => 5],
        );

        // Uncomment the below to run the seeder
        DB::table('attachments')->insert($attachments);
    }

}
