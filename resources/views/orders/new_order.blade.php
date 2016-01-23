@extends('app1')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">New Orders</div>

				<div class="panel-body">
					<div id="select-client">
					<label>Select Client</label>
					 {!!  Html::decode(Form::select('city', $clients,null, array('id' => 'client_list','class' => 'form-control'))) !!}
						
					</div>
					<div >
                     <p style="color:green;">@if(Session::has('order_created')) {{Session::get('order_created')}} @endif</p>
                      <p style="color:green;">@if(Session::has('new_client')) {{Session::get('new_client')}} @endif</p>
					</div>
		<div id="new_client_form">
		  <form  id ="create_client_form" method="POST" action="{{ url('/admin/createclient')}}">
          <input  type="hidden" name="_token" value="{{ csrf_token() }}">
	       <div class="row form-group">
			<label class="col-md-4 control-label">Client Name<strong class="requird">*</strong></label>
			<div class="col-md-6">
				<input type="text" class="form-control " name="client_name" value="{{ old('client_name') }}">
			<br>
			 @if($errors->has())
			 <p class="requird">{{$errors->first('client_name')}}</p>
			 @endif
			</div>
		   </div>
		    <div class="row form-group">
			<label class="col-md-4 control-label">Client Code<strong class="requird">*</strong></label>
			<div class="col-md-6">
				<input type="text" class="form-control " name="client_code" value="{{ old('client_code') }}">
			<br>
			 @if($errors->has())
			 <p class="requird">{{$errors->first('client_name')}}</p>
			 @endif
			</div>
		   </div>
		    <div class="row form-group">
			<label class="col-md-4 control-label">Company Internal Name<strong class="requird">*</strong></label>
			<div class="col-md-6">
				<input type="text" class="form-control " name="company_internal_name" value="{{ old('company_internal_name') }}">
			<br>
			 @if($errors->has())
			 <p class="requird">{{$errors->first('company_internal_name')}}</p>
			 @endif
			</div>
		   </div>
		    <div class="row form-group">
			<label class="col-md-4 control-label">Company Internal Code<strong class="requird">*</strong></label>
			<div class="col-md-6">
				<input type="text" class="form-control " name="company_internal_code" value="{{ old('company_internal_code') }}">
			<br>
			 @if($errors->has())
			 <p class="requird">{{$errors->first('company_internal_code')}}</p>
			 @endif
			</div>
		   </div>
		   <div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Create Client
								</button>
							</div>
						</div>
		   </form>
					</div>

					@if(Session::has('validation'))
					<div id="create-order" style="display:block; margin-top:25px;">
					@else
					 <div id="create-order" style="display:none; margin-top:25px;">
					 @endif
					  <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/orderadd') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Client<strong class="requird">*</strong></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="client" id="client" value="{{ old('client') }}">
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('client')}}</p>
							 @endif
							</div>


						</div>

						<div class="form-group">
							<label class="col-md-4 control-label"> Customer Design<strong class="requird">*</strong></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="customer_design" value="{{ old('customer_design') }}">
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('customer_design')}}</p>
							 @endif
							</div>
							
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label"> Available Design<strong class="requird">*</strong></label>
							<div class="col-md-6">
								{!! Form::select('available_design',$available_design_list,null,['class' => 'form-control'])!!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('available_design')}}</p>
							 @endif
							</div>
							
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Order Color<strong class="requird">*</strong></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="order_color" value="{{ old('order_color') }}">
							<br/>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('order_color')}}</p>
							 @endif
							</div>
							
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Available Color<strong class="requird">*</strong></label>
							<div class="col-md-6">
							{!! Form::select('available_color',$available_color_list,null,['class' => 'form-control'])!!}
								
							<br/>
							 @if($errors->has())
							 <spam class="requird">{{$errors->first('available_color')}}</spam>
							 @endif
							</div>
							
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label">Width<strong class="requird">*</strong></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="width" value="{{ old('width') }}">
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('width')}}</p>
							 @endif
							</div>
							
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Length<strong class="requird">*</strong></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="length" value="{{ old('length') }}">
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('length')}}</p>
							 @endif
							</div>
							
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Unit<strong class="requird">*</strong></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="unit" value="{{ old('unit') }}">
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('unit')}}</p>
							 @endif
							</div>
							
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Order Quantity<strong class="requird">*</strong></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="order_quantity" value="{{ old('order_quantity') }}">
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('order_quantity')}}</p>
							 @endif
							</div>
							
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Total SQMT<strong class="requird">*</strong></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="total_sqmt" value="{{ old('total_sqmt') }}">
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('total_sqmt')}}</p>
							 @endif
							</div>
							
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Quality Per SQMT<strong class="requird">*</strong></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="quality_per_sqmt" value="{{ old('quality_per_sqmt') }}">
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('quality_per_sqmt')}}</p>
							 @endif
							</div>
							
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Order Date<strong class="requird">*</strong></label>
							<div class="col-md-6">
								<input type="text" class="form-control datepicker" name="order_date" value="{{ old('order_date') }}">
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('order_date')}}</p>
							 @endif
							</div>
							
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Delivery Date<strong class="requird">*</strong></label>
							<div class="col-md-6">
								<input type="text" class="form-control datepicker" name="delivery_date" value="{{ old('delivery_date') }}">
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('delivery_date')}}</p>
							 @endif
							</div>
							
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Remarks</label>
							<div class="col-md-6">
								<input type="textarea" rows="10" cols="5" class="form-control" name="remarks" value="{{ old('remarks') }}">
							</div>

						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Create Order
								</button>
							</div>
						</div>
				        </form>
					  
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="client_account_modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Create Client</h4>
      </div>
      <div class=" modal-body">
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="create_client" class="btn btn-primary">Add Client</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-3d'
});
});

	$('#client_list').on('change',function(){
		var value = $('#client_list option:selected').val();
		//console.log(value);
		if(value == 'New')
		{
           //$('#client_account_modal').modal('show');
           // ('#create-order').hide();
           //alert($('#create_client_form').html());
           $('#create_client_form').show();
           $('#create-order').hide();
           $('#client').val('');
		}
		else if(value == '')
		{

		}
		else
		{
			$('#client').val(value);
			$('#create-order').show();
			$('#create_client_form').hide()
		}

	});
  
	// $('#create_client').on('click',function(){

         
	// 	$.ajax({
	// 		type:"post",
	// 		url:{{url('/admin/newclient')}},
	// 		data:$('#create_client_form').serialize(),
	// 		success:function(data)
	// 		{
	// 			alert(data);
	// 		}

	// 	});

	// });

</script>
@endsection