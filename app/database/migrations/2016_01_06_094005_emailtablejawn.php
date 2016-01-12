<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Emailtablejawn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emails', function($table){
			$table->increments('id');

			//Receiving Email
			$table->string('to')->unique();

			//Who the email was sent from
			$table->string('from');

			//The email's subject
			$table->string('subject');

			//The name of the receiving company
			$table->string('name');

			//Body of the email
			$table->string('body', 10000);

			//User ID of sender
			$table->integer('user_id');

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
		Schema::drop('emails');
	}

}
