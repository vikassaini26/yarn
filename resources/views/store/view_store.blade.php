@extends('app1')

@section('content')
<style type="text/css">
	th
	{
		text-align: center;
	}
	table {
  border-collapse: separate;
  border-spacing: 50px 0;

}

td {
  padding: 10px 0;
}
	
</style>
<div class="container">
	<div class="row">
		 <div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
				     <h3>Store</h3>
					 <div style='margin-top: 20px;' id="success_msg" style="color:green;">
					 @if(Session::has('item_edit'))
					   <p style="color:green" >{{Session::get('item_edit')}}</p>
					 @endif
	            
	                 </div> 
	@if(sizeof($item_list))
	<div class="table-responsive">
	                 <table style="max-width:700px;" class=".table-hover"  cellspacing="10" cellspacing="20">
	                 	<tbody>
	                 		<tr>
	                 			<th>Id</th>
	                 			<th>Item Name</th>
	                 			<th>Item Type</th>
	                 			<th>Units</th>
	                 			<th>Quantity</th>
	                 			<th>Item Description</th>
	                 			<th>Order Id</th>
	                 			<th>Vendor Name</th>
	                 			<th>Vendor Email</th>
	                 			<th>Vender Contact</th>
	                 			<th>Item Add By</th>
	                 			
	                 		</tr>
	                 		<tr>
	                 		@foreach($item_list as $data)
	                 		<tr>
	                 		<td>{{$data->id}}</td>
	                 		<td>{{$data->item_name}}</td>
	                 		<td>{{$data->item_type}}</td>
	                 		<td>{{$data->units}}</td>
	                 		<td>{{$data->quantity}}</td>
	                 		<td>{{$data->item_description}}</td>
	                 		<td>{{$data->order_id}}</td>
	                 		<td>{{$data->vendor_name}}</td>
	                 		<td>{{$data->vendor_email}}</td>
	                 		<td>{{$data->vendor_contact}}</td>
	                 		<td>{{$data->name}}</td>
	                 		
	                 		<td><a class="btn btn-primary" href="{{URL::to('/store/edititem').'/'.$data->id}}">Edit Item</a></td>
	                 		
	                 		</tr>

	                 		@endforeach
	                 		</tr>
	                 	</tbody>
	                 </table>

      </div>
	@else
	No order found yet
	@endif
			   </div>
		  </div>
	    </div>
	</div>
</div>
<script type="text/javascript">
    // admincontroller.br_grid();
</script>

			
@endsection
