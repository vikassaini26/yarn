<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use DB;
use Validator;
//use Order;
use App\Order;
use App\Client;
use Auth;
use View;
use App\Vendors;
use App\Store;

class StoreController extends Controller {

	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getAdditem()
	{
		 $vendor_list =  array('' => 'Select Vendor');
		 $vendor = Vendors::get();
		 foreach ($vendor as $key => $value) 
		 {
		 	$vendor_list[$value->id] = $value->vendor_name; 
		 }

		return View::make('store.add_new_item',['vendor_list' => $vendor_list]);
	}
	public function postAdditem()
	{
         // dd()
		$validator = Validator::make(Input::all(),[
            'item_name' => 'required',
            'item_type' => 'required',
            'quantity' => 'required',
            'units' => 'required',
            'order_id' => 'required',
            'vendor_id' => 'required',
            //'item_descreption' => 'required',
           
		    ]);
		    
		 if ($validator->fails()) {
		 	//dd($validator);
            return redirect('store/additem')
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
        	//$date = date('Y-m-d H:i:s');

        	$new_item = new Store;
        	$new_item->item_name = Input::get('item_name');
        	$new_item->units = Input::get('units');
        	$new_item->item_type = Input::get('item_type');
        	$new_item->order_id = Input::get('order_id');
        	$new_item->vendor_id = Input::get('vendor_id');
        	$new_item->quantity = Input::get('quantity');
        	$new_item->item_description = Input::get('item_description');
        	$new_item->item_added_by = Auth::id();
			$new_item->save();
        	return redirect('store/additem')->with('new_item','New item added in store succesfully');
        }
	}
	public function getStore()
	{
		$item_list = DB::table('store as s')
		 ->join('vendors as v', 'v.id', '=', 's.vendor_id','left')
		 ->join('users as u', 'u.id', '=', 's.item_added_by','left')
		 ->select('s.*','v.vendor_name','v.vendor_email','v.vendor_contact','u.name')
		 ->get();
		// dd($item_list);
        return View::make('store.view_store',['item_list' => $item_list]);
	}

	public function getEdititem($id)
	{
        $vendor_list =  array('' => 'Select Vendor');
		 $vendor = Vendors::get();
		 foreach ($vendor as $key => $value) 
		 {
		 	$vendor_list[$value->id] = $value->vendor_name; 
		 }
        $item_list = Store::find($id);
        return View::make('store.edit_item',['item_list' => $item_list,'vendor_list'=>$vendor_list]);
	}
	public function postEdititem($id)
	{

         // dd()
		$validator = Validator::make(Input::all(),[
            'item_name' => 'required',
            'item_type' => 'required',
            'quantity' => 'required',
            'units' => 'required',
            'order_id' => 'required',
            'vendor_id' => 'required',
            //'item_descreption' => 'required',
           
		    ]);
		    
		 if ($validator->fails()) {
		 	//dd($validator);
            return redirect('store/edititem/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
        	//$date = date('Y-m-d H:i:s');

        	$new_item =  Store::find($id);
        	$new_item->item_name = Input::get('item_name');
        	$new_item->units = Input::get('units');
        	$new_item->item_type = Input::get('item_type');
        	$new_item->order_id = Input::get('order_id');
        	$new_item->vendor_id = Input::get('vendor_id');
        	$new_item->quantity = Input::get('quantity');
        	$new_item->item_description = Input::get('item_description');
        	$new_item->item_added_by = Auth::id();
			$new_item->save();
        	return redirect('store/viewstore')->with('edit_item','Edit item  succesfully');
        }
	}
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
    public function getViewstore()
    {
        return View::make('store.store');
    }
    public function getViewstorelist()
    {
        $pagenum = Input::get('pagenum');
        $pagesize = Input::get('pagesize');
       // $pagesize = 50;
        $start = $pagenum * $pagesize;
        $orderfield = " ID DESC";       
        if (isset($_GET['sortdatafield']))
        {
            $sortfield = Input::get('sortdatafield');
            $sortorder = Input::get('sortorder');
            
           $pagenum = Input::get('pagenum');
                $pagesize = Input::get('pagesize');
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
        }
        $where = $this->BuildWhere();
        $query = DB::table('store as s')
         ->join('vendors as v', 'v.id', '=', 's.vendor_id','left')
         ->join('users as u', 'u.id', '=', 's.item_added_by','left')
         ->select('s.id','s.item_name','s.order_id','s.item_type','s.units','s.quantity','s.vendor_id','s.item_description','s.created_at','s.updated_at','v.vendor_name','v.vendor_email','v.vendor_contact','u.name')
         ->toSql();
         $query_data = str_replace('select', 'select SQL_CALC_FOUND_ROWS ', $query);
         // $query = "select SQL_CALC_FOUND_ROWS s.id,s.item_name,s.item_type,v.vendor_name,u.name from store as s 
         //           left join vendors as v on v.id = s.vendor_id 
         //           left join users as u on u.id = s.item_added_by";
        // dd($query);
         $query1 = $query_data.$where." order by ".$orderfield. " LIMIT $start, $pagesize";
       // dd($query1);
        $newleads = DB::select( DB::raw($query1) );
        //dd($newleads);
        $total_res = DB::select('SELECT FOUND_ROWS() as total');
        $rows = array();

        foreach($newleads as $row) {
            //$converted_by=explode('/', $row->converted_by);
            $rows[] = array(
                'id' => $row->id,
                'item_name' => $row->item_name,
                'item_type' => $row->item_type,
                'units' => $row->units,
                'quantity' => $row->quantity,
                'order_id' => $row->order_id,
                'item_description' => $row->item_description,
                'name' => $row->name,
                'vendor_id' => $row->vendor_id,
                'vendor_name' => $row->vendor_name,
                'vendor_email' => $row->vendor_email,
                'vendor_contact' => $row->vendor_contact,
                //'assigned_at' => date('Y-m-d H:i:s a', strtotime($row->assigned_at) + 60*60*5.5),
                'created_at' => date('Y-m-d H:i:s a', strtotime($row->created_at) + 60*60*5.5),
                'updated_at' => date('Y-m-d H:i:s a', strtotime($row->updated_at) + 60*60*5.5)
                
                
                
            );
        }
        $data = array();
        $data[] = array(
           'TotalRows' => $total_res[0]->total,
           'Rows' => $rows
        );
        //dd($data);
        echo json_encode($data);
       // return View::make('store.view_store',['item_list' => $item_list]);

    }

}
