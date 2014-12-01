<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkCustomerAdditionalPhotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('customer_additional_photos', function(Blueprint $table)
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
		Schema::table('customer_additional_photos', function(Blueprint $table)
		{
            $table->dropForeign('customer_additional_photos_system_user_id_foreign');
		});
	}

}
