<?php
use Illuminate\Database\Seeder;

class AvailableColorTableSeeder extends Seeder
{

	public function run()
	{

		DB::table('available_color')->insert(
			array
			(

				array('color_id' =>  '1','color_name'   	 => 'DK/CHOCO'),
			    array('color_id' =>  '2','color_name'   	 => 'DUSK'),
	 			array('color_id' =>  '7','color_name'   	 => 'PRUSSIAN BLUE'),
	            array('color_id' =>  '7','color_name'   	 => 'PURPLE'),
	            array('color_id' =>  '3','color_name'   	 => 'SAND'),
	            array('color_id' =>  '4','color_name'   	 => 'SILVER'),
	            array('color_id' =>  '5','color_name'   	 => 'SLATE'),
	            array('color_id' =>  '6','color_name'   	 => 'TAUPE'),
				array('color_id' =>  '7','color_name'   	 => 'WHITE'),
			)
			
	   );
				
    }
}