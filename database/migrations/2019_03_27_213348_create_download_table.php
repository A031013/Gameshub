<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDownloadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('download', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->integer('jogo_id')->nullable()->index('jogo_id');
			$table->integer('utilizador_id')->nullable()->index('utilizador_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('download');
	}

}
