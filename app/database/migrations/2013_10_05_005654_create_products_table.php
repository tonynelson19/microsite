<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('categoryId');
            $table->string('name', 200);
            $table->string('imageUrl', 2000)->nullable();
            $table->string('videoUrl', 200)->nullable();
            $table->text('description')->nullable();
            $table->string('status', 50)->nullable();
            $table->integer('order');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}
