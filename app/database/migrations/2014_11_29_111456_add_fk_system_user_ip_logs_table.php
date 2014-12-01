<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkSystemUserIpLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('system_user_ip_logs', function(Blueprint $table)
		{
            $table->foreign('system_user_id')->references('id')->on('system_users')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('system_user_ip_logs', function(Blueprint $table)
		{
            $table->dropForeign('system_user_ip_logs_system_user_id_foreign');
		});
	}

}
