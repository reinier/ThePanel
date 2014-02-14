<?php

use Illuminate\Database\Migrations\Migration;

class InitialDbSetup extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('users', function($table) {
            $table->increments('id');
			$table->string('publichash');
            $table->string('username');
			$table->string('email');
			$table->string('password');
			$table->string('name');
			$table->integer('activated');
			$table->string('role')->default('contributor');
			$table->text('bio');
            $table->timestamps();
        });

        Schema::create('password_reminders', function($t)
		{
			$t->string('email');
			$t->string('token');
			$t->timestamp('created_at');
		});

		Schema::create('links', function($table) {
            $table->increments('id');
            $table->integer('user_id');
			$table->string('title');
            $table->string('url');
            $table->timestamps();
            $table->softDeletes();
            $table->string('kind')->default('thing');
		    $table->text('reason')->nullable();
        });

        Schema::create('votes', function($table) {
            $table->increments('id');
            $table->integer('user_id');
			$table->integer('link_id');
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
		Schema::drop('users');
		Schema::drop('password_reminders');
		Schema::drop('links');
		Schema::drop('votes');
	}

}