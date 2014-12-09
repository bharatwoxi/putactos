<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRememberTokenToSystemUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('system_users', function(Blueprint $table)
		{
            $table->string('remember_token',255)->nullable()->after('country');;
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
            $table->dropColumn('remember_token');
		});
	}

}
