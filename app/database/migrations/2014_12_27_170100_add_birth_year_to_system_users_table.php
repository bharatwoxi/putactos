<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBirthYearToSystemUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('system_users', function(Blueprint $table)
		{
            $table->integer('current_age')->nullable()->after('birth_date');;
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('system_users', function(Blueprint $table)
		{
            $table->dropColumn('current_age');
		});
	}

}
