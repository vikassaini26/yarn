<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('new_orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('client_id');
			$table->string('customer_design',32);
			$table->string('available_design',32);
			$table->string('order_color',32);
			$table->string('available_color',32);
			$table->string('width',32);
			$table->string('length',32);
			$table->string('unit',32);
			$table->string('order_quantity',32);
			$table->string('total_sqmt',32);
			$table->float('quality_per_sqmt');
			$table->text('remarks');
			$table->tinyInteger('created_by')->default(0);
			//$table->timestamp('created_on')->nullable();
			$table->date('order_date');
			$table->date('delivery_date');
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
		Schema::drop('new_orders');
	}

}
