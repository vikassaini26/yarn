<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getRegister()
	{
		return view('auth.register');
	}
	public function postRegister()
	{
		 $validator = Validator::make(Input::all(), Account::registerRules());

        if ($validator->fails()) {
            return redirect('account/register')
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
		return view('auth.register');
     	}
	}

}
