<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOriginalNameToCustomerAdditionalPhotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('customer_additional_photos', function(Blueprint $table)
		{
            $table->string('original_name',255)->after('image_name');
            $table->string('file_size',255)->after('original_name');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('customer_additional_photos', function(Blueprint $table)
		{
            $table->dropColumn('original_name');
            $table->dropColumn('file_size');
		});
	}

}
