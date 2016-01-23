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
				     <h3>Vendor List</h3>
					 <div style='margin-top: 20px;' id="success_msg" style="color:green;">
					 @if(Session::has('vendor_edit'))
					   <p style="color:green" >{{Session::get('vendor_edit')}}</p>
					 @endif
	            
	                 </div> 
	@if(sizeof($vendor))
	<div class="table-responsive">
	                 <table style="max-width:700px;" class=".table-hover"  cellspacing="10" cellspacing="20">
	                 	<tbody>
	                 		<tr>
	                 			<th>Id</th>
	                 			<th>Vendor Name</th>
	                 			<th>Vendor Email</th>
	                 			<th>Vendor Contact</th>
	                 			<th>Alternet Contact</th>
	                 			<th>Address</th>
	                 			<th>Pin Code</th>
	                 			<th>Country</th>
	                 			<th>state</th>
	                 			<th>City</th>
	                 			<th>About</th>
	                 			
	                 		</tr>
	                 		<tr>
	                 		@foreach($vendor as $data)
	                 		<tr>
	                 		<td>{{$data['id']}}</td>
	                 		<td>{{$data['vendor_name']}}</td>
	                 		<td>{{$data['vendor_email']}}</td>
	                 		<td>{{$data['vendor_contact']}}</td>
	                 		<td>{{$data['vendor_alternet_contact']}}</td>
	                 		<td>{{$data['vendor_address']}}</td>
	                 		<td>{{$data['vendor_pin_code']}}</td>
	                 		<td>{{$data['country']}}</td>
	                 		<td>{{$data['state']}}</td>
	                 		<td>{{$data['city']}}</td>
	                 		<td>{{$data['about_vendor']}}</td>
	                 		
	                 		<td><a class="btn btn-primary" href="{{URL::to('/admin/editvendor').'/'.$data['id']}}">Edit Vendor</a></td>
	                 		
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