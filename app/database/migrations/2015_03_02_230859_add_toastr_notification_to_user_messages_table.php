<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToastrNotificationToUserMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_messages', function(Blueprint $table)
		{
            $table->tinyInteger('toastr_notification')->default(1)->after('is_new');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_messages', function(Blueprint $table)
		{
            $table->dropColumn('toastr_notification');
		});
	}

}
