<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemUserIpLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('system_user_ip_logs', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unique();
            $table->bigInteger('system_user_id')->unsigned();
            $table->string('ip_address',255)->nullable();
            $table->string('browser',255)->nullable();
            $table->string('os',255)->nullable();
            $table->timestamp('login_time');
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('system_user_ip_logs');
	}

}
