<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageByRatio62By54ToSystemUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('system_users', function(Blueprint $table)
		{
            $table->string('image_62by54',255)->nullable()->after('image_250by180');
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
            $table->dropColumn('image_62by54');
		});
	}

}
