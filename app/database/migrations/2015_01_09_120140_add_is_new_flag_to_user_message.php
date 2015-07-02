<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsNewFlagToUserMessage extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_messages', function(Blueprint $table)
		{
            $table->tinyInteger('is_new')->default(1)->after('message');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_messages', function(Blueprint $table)
		{
            $table->dropColumn('is_new');
		});
	}

}
