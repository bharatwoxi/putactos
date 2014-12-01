<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserRoleSeeder');
        $this->command->info('User_role table seeded!');
    	$this->call('KnownLanguageSeeder');
        $this->command->info('known_Language table seeded!');
	}

}
