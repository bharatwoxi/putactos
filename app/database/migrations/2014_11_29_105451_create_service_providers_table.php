<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceProvidersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_providers', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unique();
            $table->integer('riseme_up')->default(0);
            $table->string('profile_completeness',255)->nullable();
            $table->integer('visit_frequency')->nullable();
            $table->string('turns_me_on',255)->nullable();
            $table->string('expertise',255)->nullable();
            $table->tinyInteger('pubic_hair')->nullable();
            $table->integer('bust')->nullable();
            $table->integer('cup_size')->nullable();
            $table->integer('waist')->nullable();
            $table->integer('hips')->nullable();
            $table->integer('ethnicity')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('height')->nullable();
            $table->integer('eye_color')->nullable();
            $table->integer('hair_color')->nullable();
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
		Schema::dropIfExists('service_providers');
	}

}
