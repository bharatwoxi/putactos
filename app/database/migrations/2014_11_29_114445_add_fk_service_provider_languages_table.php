<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkServiceProviderLanguagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('service_provider_languages', function(Blueprint $table)
		{
            $table->foreign('known_languages_id')->references('id')->on('known_languages_master')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('service_provider_id')->references('id')->on('service_providers')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('service_provider_languages', function(Blueprint $table)
		{
            $table->dropForeign('service_provider_languages_known_languages_master_id_foreign');
            $table->dropForeign('service_provider_languages_service_provider_id_foreign');
		});
	}

}
