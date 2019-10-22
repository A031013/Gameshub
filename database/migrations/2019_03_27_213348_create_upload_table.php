<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUploadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('upload', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->integer('jogo_id')->nullable()->index('jogo_id');
			$table->integer('utilizador_id')->nullable()->index('utilizador_id');
			$table->integer('tamanho')->nullable();
			$table->date('data_upload')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('upload');
	}

}
