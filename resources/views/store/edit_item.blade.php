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
				     <h3> Edit Item</h3>
					<!--  <div style='margin-top: 20px;' id="jqxgrid">
	            
	                 </div> -->
	                 @if(Session::has('edit_item'))
	                 <div>
	                 
	                 <p style="color:green"> {{Session::get('edit_item')}}</p>
	                 </div>
	                 @endif
	                <div id="create-order" style="display:block; margin-top:25px;">
					
					    {!!Form::model($item_list,array('url' => "/store/edititem/".$item_list->id, 'method' => 'post'))!!}
						

						<div class="form-group">
							<label class="col-md-4 control-label">Item Name<strong class="requird">*</strong></label>
							<div class="col-md-6">
								 {!! Form::text('item_name',null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('item_name')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Units<strong class="requird">*</strong></label>
							<div class="col-md-6">
								 {!! Form::text('units', null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('units')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Quantity<strong class="requird">*</strong></label>
							<div class="col-md-6">
								 {!! Form::text('quantity', null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('quantity')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Item Type<strong class="requird">*</strong></label>
							<div class="col-md-6">
								 {!! Form::text('item_type' ,null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('item_type')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Item Description</label>
							<div class="col-md-6">
								 {!! Form::textarea('item_description' ,null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('item_description')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Order Id<strong class="requird">*</strong></label>
							<div class="col-md-6">
								 {!! Form::text('order_id' ,null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('order_id')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Select Vendor<strong class="requird">*</strong></label>
							<div class="col-md-6">
								 {!! Form::select('vendor_id',$vendor_list,null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('vendor_id')}}</p>
							 @endif
					    </div>
						</div>
					
						<div class="form-group">
							<div class="col-md-6">
							  {!! Form::submit('Submit', array('class' => 'btn submit-bttn singn-up-bttn btn-success ')) !!}
							</div>
						</div>
  
{!! Form::close() !!}

   				</div>
		  </div>
	    </div>
	</div>
</div>
@stop