<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('system_users', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unique();
            $table->string('username',255)->unique();
            $table->string('password',255);
            $table->string('email',255)->unique();
            $table->string('contact_no',255)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('gender',255)->nullable();
            $table->integer('is_active')->default(1);
            $table->string('user_first_name',255)->nullable();
            $table->string('user_last_name',255)->nullable();
            $table->string('profile_image',255)->nullable();
            $table->bigInteger('user_role_id')->unsigned();
            $table->bigInteger('service_provider_id')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->bigInteger('from_age')->nullable();
            $table->bigInteger('to_age')->nullable();
            $table->string('latitude',255)->nullable();
            $table->string('longitude',255)->nullable();
            $table->string('city',255)->nullable();
            $table->string('country',255)->nullable();
            $table->timestamps(); //For created & updated at
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('system_users');
	}

}
