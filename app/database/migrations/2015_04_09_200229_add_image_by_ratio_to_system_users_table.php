<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageByRatioToSystemUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('system_users', function(Blueprint $table)
		{
            $table->string('image_330by220',255)->nullable()->after('profile_image');
            $table->string('image_250by180',255)->nullable()->after('image_330by220');
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
            $table->dropColumn('image_330by220');
            $table->dropColumn('image_250by180');
		});
	}

}
