<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->string('nome', 30)->nullable();
			$table->string('email', 255);
			$table->string('password', 255);
			$table->string('morada', 50)->nullable();
			$table->string('cod_postal', 8)->nullable()->index('cod_postal');
			$table->date('data_nascimento')->nullable();
			$table->string('menber_status', 20)->nullable();
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
	}

}
