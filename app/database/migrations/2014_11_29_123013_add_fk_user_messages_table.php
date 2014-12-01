<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkUserMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_messages', function(Blueprint $table)
		{
            $table->foreign('from_user_id')->references('id')->on('system_users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('to_user_id')->references('id')->on('system_users')->onDelete('cascade')->onUpdate('cascade');
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
            $table->dropForeign('user_messages_from_user_id_foreign');
            $table->dropForeign('user_messages_to_user_id_foreign');
		});
	}

}
