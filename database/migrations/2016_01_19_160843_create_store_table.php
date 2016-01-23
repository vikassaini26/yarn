<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('store', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('item_name',64);
			$table->string('units',64);
			$table->string('quantity',64);
			$table->string('item_type',64);
			$table->text('item_description',64);
			$table->integer('order_id');
			$table->integer('vendor_id');
			$table->tinyInteger('item_added_by')->default(0);
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
		Schema::drop('store');
	}

}
