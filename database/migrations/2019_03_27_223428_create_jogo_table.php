<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJogoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jogo', function(Blueprint $table)
		{
			$table->integer('jogo_id')->primary();
			$table->string('nome', 30)->nullable();
			$table->string('proprietario', 80)->nullable()->index('proprietario');
			$table->string('descricao', 250)->nullable();
			$table->string('demo', 100)->nullable();
			$table->date('data_lancamento')->nullable();
			$table->string('requisitos', 200)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('jogo');
	}

}
