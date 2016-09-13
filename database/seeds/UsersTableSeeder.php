<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    public function run() {
        DB::table('users')->delete();

        $users = array(
            ['id' => 1, 
             'name' => 'admin',
             'email' => 'admin@example.com',
             'password' => Hash::make('admin')],
            ['id' => 2, 
             'name' => 'alice',
             'email' => 'alice@example.com',
             'password' => Hash::make('alice')],
            ['id' => 3, 
             'name' => 'bob',
             'email' => 'bob@example.com',
             'password' => Hash::make('bob')],
            ['id' => 4, 
             'name' => 'charlie',
             'email' => 'charlie@example.com',
             'password' => Hash::make('charlie')],
            ['id' => 5, 
             'name' => 'dave',
             'email' => 'dave@example.com',
             'password' => Hash::make('dave')],
        );

        // Uncomment the below to run the seeder
        DB::table('users')->insert($users);
    }

}
