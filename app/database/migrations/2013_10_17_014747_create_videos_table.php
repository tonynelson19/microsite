<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVideosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Eloquent::unguard();

        Schema::create('videos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('productId');
            $table->string('videoUrl', 2000);
            $table->string('caption', 200)->nullable();
            $table->string('status', 50)->nullable();
            $table->integer('order');
        });

        /** @var Product[] $products */
        $products = Product::where('videoUrl', '!=', '')->get();

        foreach ($products as $product) {

            Video::create(array(
                'productId' => $product->id,
                'videoUrl'  => $product->videoUrl,
                'caption'   => '',
                'status'    => Video::STATUS_ACTIVE,
                'order'     => 1,
            ));

        }

        Schema::table('products', function($table)
        {
            $table->dropColumn('videoUrl');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('videos');
	}

}