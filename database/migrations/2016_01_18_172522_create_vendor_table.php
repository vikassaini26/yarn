<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vendors', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('vendor_name',255);
			$table->string('vendor_email',64);
			$table->string('vendor_contact',16);
			$table->string('vendor_alternet_contact',16);
			$table->text('about_vendor');
			$table->text('vendor_address');
			$table->text('vendor_pin_code');
			$table->string('country',128);
			$table->string('state',128);
			$table->string('city',128);
			$table->tinyInteger('created_by')->default(0);
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
		Schema::drop('vendor');
	}

}
