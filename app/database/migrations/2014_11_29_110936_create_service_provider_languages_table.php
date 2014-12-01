<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceProviderLanguagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_provider_languages', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unique();
            $table->bigInteger('known_languages_id')->unsigned();
            $table->bigInteger('service_provider_id')->unsigned();
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
		Schema::dropIfExists('service_provider_languages');
	}

}
