<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\Validator;
use DB;
use Validator;
//use Order;
use App\Order;
use App\Client;
use Auth;
use View;
use App\Vendors;

class AdminController extends Controller {

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
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	function BuildWhere($modifier = array()){
		//$modifier is an array suppose if you want to modify the fieldname for eg. firstname='aman' to p.firstname='aman'
		// You need to define array like this $marr = array('firstname' =>'p.firstname'  );


		// filter data.
		if (isset($_REQUEST['filterscount']))
		{
		  $filterscount = $_REQUEST['filterscount'];
		  
		  if ($filterscount > 0)
		  {
		    $where = " WHERE (";
		    $tmpdatafield = "";
		    $tmpfilteroperator = "";
		    for ($i=0; $i < $filterscount; $i++)
		      {
		      // get the filter's value.
		      $filtervalue = addslashes($_REQUEST["filtervalue" . $i]);

		      if ($filtervalue == 'true' or $filtervalue == 'false'){
		      	$filtervalue = filter_var($filtervalue, FILTER_VALIDATE_BOOLEAN);
		      }

		      // get the filter's condition.
		      $filtercondition = $_REQUEST["filtercondition" . $i];
		      // get the filter's column.
		      $filterdatafield = $_REQUEST["filterdatafield" . $i];

	          if (array_key_exists($filterdatafield, $modifier) ){
	            $filterdatafield=$modifier[$filterdatafield];
	          }

		      // get the filter's operator.
		      $filteroperator = $_REQUEST["filteroperator" . $i];
		      
		      if ($tmpdatafield == "")
		      {
		        $tmpdatafield = $filterdatafield;      
		      }
		      else if ($tmpdatafield <> $filterdatafield)
		      {
		        $where .= ")AND(";
		      }
		      else if ($tmpdatafield == $filterdatafield)
		      {
		        if ($tmpfilteroperator == 0)
		        {
		          $where .= " AND ";
		        }
		        else $where .= " OR ";  
		      }
		      
		      // build the "WHERE" clause depending on the filter's condition, value and datafield.
		      switch($filtercondition)
		      {
		        case "CONTAINS":
		          $where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."%'";
		          break;
	          	case "SECRET_EQUAL":
		          $where .= " id ='" . Common::getDecode_hash_id($filtervalue) . "' ";
		          break;
		        case "DOES_NOT_CONTAIN":
		          $where .= " " . $filterdatafield . " NOT LIKE '%" . $filtervalue ."%'";
		          break;
		        case "EQUAL":
		          $where .= " " . $filterdatafield . " = '" . $filtervalue ."'";
		          break;
		        case "NOT_EQUAL":
		          $where .= " " . $filterdatafield . " <> '" . $filtervalue ."'";
		          break;
		        case "GREATER_THAN":
		          $where .= " " . $filterdatafield . " > '" . $filtervalue ."'";
		          break;
		        case "LESS_THAN":
		          $where .= " " . $filterdatafield . " < '" . $filtervalue ."'";
		          break;
		        case "GREATER_THAN_OR_EQUAL":
		          $where .= " " . $filterdatafield . " >= '" . $filtervalue ."'";
		          break;
		        case "LESS_THAN_OR_EQUAL":
		          $where .= " " . $filterdatafield . " <= '" . $filtervalue ."'";
		          break;
		        case "STARTS_WITH":
		          $where .= " " . $filterdatafield . " LIKE '" . $filtervalue ."%'";
		          break;
		        case "ENDS_WITH":
		          $where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."'";
		          break;
		      }
		              
		      if ($i == $filterscount - 1)
		      {
		        $where .= ")";
		      }
		      
		      $tmpfilteroperator = $filteroperator;
		      $tmpdatafield = $filterdatafield;      
		    }
		    
		    return $where;
		  }
		}
	}


	public function getHome()
	{
		return view('admin.home');
	}
	public function getShoworders()
	{
		
		return View::make('orders.order_list');
	}
	public function getOrderslist()
	{
		
    	$pagenum = Input::get('pagenum');
		$pagesize = Input::get('pagesize');		
		// $pagenum = 0;
		// $pagesize = 50;
		$start = $pagenum * $pagesize;

		// sort data.
		$orderfield = " ID ASC";		
		if (isset($_GET['sortdatafield']))
		{
			$sortfield = Input::get('sortdatafield');
			$sortorder = Input::get('sortorder');
			
			if ($sortfield != NULL)
			{
				if ($sortorder == "desc")
				{
					$orderfield = $sortfield . " DESC";
				}
				else if ($sortorder == "asc")
				{	
					$orderfield = $sortfield . " ASC";
					
				}			
			}
		}

        $query = DB::table('new_orders as no')
		  ->join('clients as c', 'c.id', '=', 'no.client_id','left')
		  ->join('available_color as ac', 'ac.color_id', '=', 'no.available_color','left')
		  ->join('available_design as ad', 'ad.id', '=', 'no.available_design','left')
		  ->join('users as u', 'u.id', '=', 'no.created_by','left')
          ->select(
          'no.id',
          'c.client_name',
          'c.company_internal_name',
          'no.customer_design',
          'ad.design_name',
          'no.order_color',
          'ac.color_name',
          'no.width',
          'no.length',
          'no.unit',
          'no.order_quantity',
          'no.total_sqmt',
          'no.quality_per_sqmt',
          'no.remarks',
          'no.created_by',
          'no.order_date',
          'no.delivery_date',
          'u.name',
         
          DB::raw("CONVERT_TZ(no.created_at,'+00:00','+5:30') as created_at"),
          DB::raw("CONVERT_TZ(no.updated_at,'+00:00','+5:30') as updated_at"))
          ->toSql();   

		
		$where = $this->BuildWhere();
		$where = str_replace(" id ", " no.id ", $where);
        $where = str_replace("yarn_length ", " no.length ", $where);
       // $where = str_replace(" host_name ", " uh.name ", $where);
       // $where = str_replace(" traveller_name ", " ut.name ", $where);
       // $where = str_replace(" pid ", " b.pid ", $where);
		
		
		 $query = str_replace("select", "select SQL_CALC_FOUND_ROWS ", $query);

            
		$payout_data = DB::select( DB::raw($query.' '.$where." order by ".$orderfield. " LIMIT $start, $pagesize"));
       // dd($query1);) ); 
		//dd($payout_data); 
	
		$total_res = DB::select('SELECT FOUND_ROWS() as total');
		$brequests =array();
		 //$total_rows =$br_count[0]->countproperties;
		foreach($payout_data as $row) {
			// dd($row->id);
			$brequests[] = array(
			 	'id' => $row->id,
			 	'client_name' => $row->client_name,
			 	'company_internal_name' => $row->company_internal_name,
				'customer_design' => $row->customer_design,
				'design_name' => $row->design_name,
				'order_color' => $row->order_color,
				'color_name' => $row->color_name,
				'width' => $row->width,
				'yarn_length' => $row->length,
				'name' => $row->name,
				'unit' => $row->unit,
				'order_quantity' =>$row->order_quantity,
				'total_sqmt' =>$row->total_sqmt,
				'quality_per_sqmt' =>$row->quality_per_sqmt,
				'remarks' =>$row->remarks,
				'order_date' =>$row->order_date,
				'delivery_date' =>$row->delivery_date,
				'created_at' =>$row->created_at,
				'updated_at' =>$row->updated_at,
			);
		}
		//dd($brequests);
		$data = array();
		//if (!isset($brequests)){$brequests = [];}
		$data[] = array(
	       'TotalRows' => $total_res[0]->total,
		   'Rows' => $brequests
		);
		//dd($data);

		 echo json_encode($data);

    }


	public function getOrders()
	{
		$user = DB::table('users')->get();
		//dd($user);
		 $clients =  array('' => 'select client','New' => 'Add Client');
		$client = DB::table('clients')->get();
		foreach ($client as $key => $value) {

			$clients[$value->id] = $value->client_name; 
		}
		$user = DB::table('users')->get();
		//dd($user);
		$available_color_list =  array('' => 'select Available Color');
		$available_color = DB::table('available_color')->get();
		foreach ($available_color as $key => $value) {

			$available_color_list[$value->color_id] = $value->color_name; 
		}
		
        $available_design_list =  array('' => 'select Available Design');
		$available_design = DB::table('available_design')->get();
		foreach ($available_design as $key => $value) {

			$available_design_list[$value->design_id] = $value->design_name; 
		}

		//$client['New'] = 'Add Client';
		return View::make('orders.new_order',['clients' => $clients,'available_color_list' => $available_color_list,'available_design_list'=>$available_design_list]);
	}
	public function postOrderadd()
	{
		//dd(Input::all());
		$validator = Validator::make(Input::all(),[
            'customer_design' => 'required',
            'client' => 'required',
            'available_design' => 'required',
            'order_color' => 'required',
            'available_color' => 'required',
            'width' => 'required',
            'length' => 'required',
            'unit' => 'required',
            'order_quantity' => 'required',
            'total_sqmt' => 'required',
		    'quality_per_sqmt' => 'required',
		    'order_date' => 'required',
		    'delivery_date' => 'required',
		    ]);
		    
		 if ($validator->fails()) {
		 	//dd($validator);
            return redirect('admin/orders')
                        ->withErrors($validator)
                        ->withInput()->with('validation','validation');
        }
        else
        {
        	//$date = date('Y-m-d H:i:s');

        	$order = new Order;
        	$order->client_id = Input::get('client');
        	$order->customer_design = Input::get('customer_design');
        	$order->available_design = Input::get('available_design');
        	$order->order_color = Input::get('order_color');
        	$order->available_color = Input::get('available_color');
        	$order->width = Input::get('width');
        	$order->length = Input::get('length');
        	$order->order_quantity = Input::get('order_quantity');
        	$order->unit = Input::get('unit');
        	$order->total_sqmt = Input::get('total_sqmt');
        	$order->quality_per_sqmt = Input::get('quality_per_sqmt');
        	$order->order_date = Input::get('order_date');
        	$order->delivery_date = Input::get('delivery_date');
        	$order->created_by = Auth::id();
        	$order->created_by = date('Y-m-d H:S:i');
        	$order->save();
           return redirect('admin/orders')->with('order_created','New order created succesfully');
           
        }
	}
	public function postCreateclient()
	{
		$validator = Validator::make(Input::all(),[
            'client_name' => 'required',
            'company_internal_name' => 'required',
            'company_internal_code' => 'required',
            'client_code' => 'required',
           
		    ]);
		    
		 if ($validator->fails()) {
		 	//dd($validator);
            return redirect('admin/orders')
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
        	//$date = date('Y-m-d H:i:s');

        	$client = new client;
        	$client->client_name = Input::get('client_name');
        	$client->company_internal_name = Input::get('company_internal_name');
        	$client->company_internal_code = Input::get('company_internal_code');
        	$client->client_code = Input::get('client_code');

        	$client->save();
        	return redirect('admin/orders')->with('new_client','New client profile created succesfully');
        }
        	
	}
	public function getEditorder($id)
	{
        $order =  Order::find($id);
        $available_color_list =  array('' => 'select Available Color');
		$available_color = DB::table('available_color')->get();
		foreach ($available_color as $key => $value) {

			$available_color_list[$value->color_id] = $value->color_name; 
		}
		$available_design_list =  array('' => 'select Available Design');
		$available_design = DB::table('available_design')->get();
		foreach ($available_design as $key => $value) {

			$available_design_list[$value->design_id] = $value->design_name; 
		}
		
        return View::make('orders.edit_order',['order'=>$order,'available_color_list' => $available_color_list,'available_design_list'=>$available_design_list]);  
	}
	public function postEditorders($id)
	{
		//dd(Input::all());
		$validator = Validator::make(Input::all(),[
            'customer_design' => 'required',
            //'client' => 'required',
            'available_design' => 'required',
            'order_color' => 'required',
            'available_color' => 'required',
            'width' => 'required',
            'length' => 'required',
            'unit' => 'required',
            'order_quantity' => 'required',
            'total_sqmt' => 'required',
		    'quality_per_sqmt' => 'required',
		    'order_date' => 'required',
		    'delivery_date' => 'required',
		    ]);
		    
		 if ($validator->fails()) {
		 	//dd($validator);
            return redirect('admin/editorder/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
        	$edit_order = Order::find($id);
        	//print_r(Input::all());
        	//dd($edit_order);
        	$edit_order->customer_design = Input::get('customer_design');
        	$edit_order->available_design = Input::get('available_design');
        	$edit_order->order_color = Input::get('order_color');
        	$edit_order->available_color = Input::get('available_color');
        	$edit_order->width = Input::get('width');
        	$edit_order->length = Input::get('length');
        	$edit_order->order_quantity = Input::get('order_quantity');
        	$edit_order->unit = Input::get('unit');
        	$edit_order->total_sqmt = Input::get('total_sqmt');
        	$edit_order->quality_per_sqmt = Input::get('quality_per_sqmt');
        	$edit_order->order_date = Input::get('order_date');
        	$edit_order->delivery_date = Input::get('delivery_date');
        	$edit_order->created_by = Auth::id();
        	//$edit_order->created_by = date('Y-m-d H:S:i');
        	$edit_order->save();
        	return redirect('admin/showorders')->with('orderEdit' ,'Order succesfully edit');

        }
	}
	public function getVendor()
	{
		return View::make('orders.add_vendor');

	}
	public function  postNewvendor()
	{
		$validator = Validator::make(Input::all(),[
        'vendor_name' => 'required',
        'vendor_email' => 'required|email|unique:vendors',
        'vendor_contact' => 'required|numeric|digits_between:8,13',
        'vendor_alternet_contact' => 'numeric|digits_between:8,15',
        //'about_vendor' => 'required',
        'vendor_address' => 'required',
        'vendor_pin_code' => 'required|numeric',
        'country' => 'required',
	    'state' => 'required',
	    'city' => 'required',
	   // 'delivery_date' => 'required',
	    ]);
		    
		 if ($validator->fails()) {
		 	//dd($validator);
            return redirect('admin/vendor')
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
        	$vendor = new Vendors;
        	$vendor->vendor_name = Input::get('vendor_name');
        	$vendor->vendor_email = Input::get('vendor_email');
        	$vendor->vendor_contact = Input::get('vendor_contact');
        	$vendor->vendor_alternet_contact = Input::get('vendor_alternet_contact');
        	$vendor->about_vendor = Input::get('about_vendor');
        	$vendor->vendor_address = Input::get('vendor_address');
        	$vendor->vendor_pin_code = Input::get('vendor_pin_code');
        	$vendor->country = Input::get('country');
        	$vendor->state = Input::get('state');
        	$vendor->city = Input::get('city');
        	$vendor->about_vendor = Input::get('about_vendor');
        	$vendor->save();
        	 return redirect('admin/vendor')->with('vendor_created','New vendor Created succesfully');
        }

	}
	public function getVendorlist()
	{
		$vendor =  Vendors::get();
		return View::make('orders.view_vendor',['vendor' => $vendor]);
	}
	public function getEditvendor($id)
	{
		$vendor =  Vendors::find($id);
		return View::make('orders.edit_vendor',['vendor' => $vendor]);

	}

	public function postEditvendor($id)
	{
		$validator = Validator::make(Input::all(),[
        'vendor_name' => 'required',
        'vendor_email' => 'required|email',
        'vendor_contact' => 'required|numeric|digits_between:8,13',
        'vendor_alternet_contact' => 'numeric|digits_between:8,15',
        //'about_vendor' => 'required',
        'vendor_address' => 'required',
        'vendor_pin_code' => 'required|numeric',
        'country' => 'required',
	    'state' => 'required',
	    'city' => 'required',
	   // 'delivery_date' => 'required',
	    ]);
		    
		 if ($validator->fails()) {
		 	//dd($validator);
            return redirect('admin/editvendor/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
        	$vendor = Vendors::find($id);
        	$vendor->vendor_name = Input::get('vendor_name');
        	$vendor->vendor_email = Input::get('vendor_email');
        	$vendor->vendor_contact = Input::get('vendor_contact');
        	$vendor->vendor_alternet_contact = Input::get('vendor_alternet_contact');
        	$vendor->about_vendor = Input::get('about_vendor');
        	$vendor->vendor_address = Input::get('vendor_address');
        	$vendor->vendor_pin_code = Input::get('vendor_pin_code');
        	$vendor->country = Input::get('country');
        	$vendor->state = Input::get('state');
        	$vendor->city = Input::get('city');
        	$vendor->about_vendor = Input::get('about_vendor');
        	$vendor->save();
        	 return redirect('admin/vendorlist')->with('vendor_edit','New vendor edited succesfully');
        }

	}
	
}
