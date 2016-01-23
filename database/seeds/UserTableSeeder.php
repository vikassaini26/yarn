<?php
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

	public function run()
	{

		User::create(array(
            'name'		 => 'Vikas',
			'email'   	 => 'vikasgeu24@gmail.com',
			'password'	 =>  Hash::make('123456'),
			//'dob'    	 => '1990-10-06',
			'is_super'=> 1,
			'is_enable'=> 1
			
			//'confirmation_code' => ''
		));

	
	}
}