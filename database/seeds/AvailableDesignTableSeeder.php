<?php
use Illuminate\Database\Seeder;

class AvailableDesignTableSeeder extends Seeder
{

	public function run()
	{

		DB::table('available_design')->insert(
			array(
				array('design_id' =>  '6','design_name'   	 => 'ASCOT'),
				array('design_id' =>  '7','design_name'   	 => 'BEATRICE'),
				array('design_id' =>  '3','design_name'   	 => 'EDGE'),
			    array('design_id' =>  '2','design_name'   	 => 'GORSVENOR'),
	            array('design_id' =>  '4','design_name'   	 => 'GLAMOUR'),
	            array('design_id' =>  '5','design_name'   	 => 'MICA'),
	            array('design_id' =>  '1','design_name'   	 => 'PLUSE SHAGGY'),
	        )
	    );
            
		
	}
}