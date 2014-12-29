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
        $this->call('EthnicitySeeder');
        $this->command->info('ethnicity_master table seeded!');
        $this->call('EyeColorSeeder');
        $this->command->info('eye_color_master table seeded!');
        $this->call('HairColorSeeder');
        $this->command->info('hair_color_master table seeded!');
        $this->call('WeekDaySeeder');
        $this->command->info('week_day_master table seeded!');
	}

}
