<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPenisSizeToServiceProviderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('service_providers', function(Blueprint $table)
		{
            $table->integer('penis_size')->nullable()->after('cup_size');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('service_providers', function(Blueprint $table)
		{
            $table->dropColumn('penis_size');
		});
	}

}
