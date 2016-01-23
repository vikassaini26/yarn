<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
	protected $guarded = array('id');

	protected $table = 'new_orders';

}
