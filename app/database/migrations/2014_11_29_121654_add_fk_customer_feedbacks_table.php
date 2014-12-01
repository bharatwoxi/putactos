<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkCustomerFeedbacksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('customer_feedbacks', function(Blueprint $table)
		{
            $table->foreign('service_provider_id')->references('id')->on('system_users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('customer_id')->references('id')->on('system_users')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('customer_feedbacks', function(Blueprint $table)
		{
            $table->dropForeign('customer_feedbacks_service_provider_id_foreign');
            $table->dropForeign('customer_feedbacks_customer_id_foreign');
		});
	}

}
