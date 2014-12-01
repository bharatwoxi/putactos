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
            $table->string('visit_frequency',255)->nullable();
            $table->string('turns_me_on',255)->nullable();
            $table->string('expertise',255)->nullable();
            $table->string('pubic_hair',255)->nullable();
            $table->string('bust',255)->nullable();
            $table->string('cup_size',255)->nullable();
            $table->string('waist',255)->nullable();
            $table->string('hips',255)->nullable();
            $table->string('ethnicity',255)->nullable();
            $table->string('weight',255)->nullable();
            $table->string('height',255)->nullable();
            $table->string('eye_color',255)->nullable();
            $table->string('hair_color',255)->nullable();
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
