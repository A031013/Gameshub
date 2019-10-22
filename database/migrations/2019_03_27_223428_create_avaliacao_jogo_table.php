<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAvaliacaoJogoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('avaliacao_jogo', function(Blueprint $table)
		{
			$table->integer('jogo_id');
			$table->integer('utilizador_id');
			$table->integer('rating')->nullable();
			$table->date('data_avaliacao')->nullable();
			$table->primary(['jogo_id','utilizador_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('avaliacao_jogo');
	}

}
