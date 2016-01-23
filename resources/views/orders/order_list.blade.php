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
				     <h3>Orders List</h3>
				      <input type="button" class="btn btn-default " id="edit_order_btn" value="Edit Item" /> 
				     <button class='btn btn-default  pull-right reset-filter'>Reset Filters</button>
					 <div style='margin-top: 20px;' id="success_msg" style="color:green;">
					 @if(Session::has('orderEdit'))
					    {{Session::get('orderEdit')}}
					 @endif
	            
	                 </div> 
	                  <div style='margin-top: 20px;' id="jqxgrid">
            
                      </div>
	
			   </div>
		  </div>
	    </div>
	</div>
</div>
<script type="text/javascript">
     admincontroller.order_grid();
      var base_url = '{{URL::to('/')}}';

    $('#edit_order_btn').on('click',function(){
     	var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
        var datarow = $("#jqxgrid").jqxGrid('getrowdata', selectedrowindex);
        var rowscount = $('#jqxgrid').jqxGrid('getselectedrowindexes').length;
      
        if(rowscount==0)
        {
          //$('#message').show();
          alert('Please select a  order.');
          return;

        }

        window.location = base_url+'/admin/editorder/'+datarow.id;

     });
</script>

			
@endsection