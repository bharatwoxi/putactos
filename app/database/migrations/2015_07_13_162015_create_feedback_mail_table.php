<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackMailTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback_mail', function(Blueprint $table)
        {
            $table->increments('id');
            $table->bigInteger('service_provider_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned();
            $table->tinyInteger('mail_sent')->unsigned();
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
        Schema::drop('feedback_mail');
    }

}
