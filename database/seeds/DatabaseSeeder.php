<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('UserTableSeeder');

        \Api\User::create([
            'first_name' => 'Conar',
            'last_name' => 'Welsh',
            'email' => 'conar@sellwell.io',
            'password' => bcrypt('password')
        ]);

        \Api\Status::create([
            'user_id' => 1,
            'content' => 'This is a test'
        ]);
	}

}
