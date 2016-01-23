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
				     <h3> Edit Order</h3>
					<!--  <div style='margin-top: 20px;' id="jqxgrid">
	            
	                 </div> -->
	                <div id="create-order" style="display:block; margin-top:25px;">
					
					    {!!Form::model($order, array('url' => "/admin/editorders/".$order->id, 'method' => 'post'))!!}
						

						<div class="form-group">
							<label class="col-md-4 control-label">Customer Design<strong class="requird">*</strong></label>
							<div class="col-md-6">
								 {!! Form::text('customer_design',null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('customer_design')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Available Design<strong class="requird">*</strong></label>
							<div class="col-md-6">
								 {!! Form::select('available_design',$available_design_list, null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('available_design')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Order Color<strong class="requird">*</strong></label>
							<div class="col-md-6">
								 {!! Form::text('order_color', null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('order_color')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Available Color<strong class="requird">*</strong></label>
							<div class="col-md-6">
								 {!! Form::select('available_color',$available_color_list ,null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('available_color')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Width<strong class="requird">*</strong></label>
							<div class="col-md-6">
								 {!! Form::text('width', null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('width')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Length<strong class="requird">*</strong></label>
							<div class="col-md-6">
								 {!! Form::text('length', null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('length')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Unit<strong class="requird">*</strong></label>
							<div class="col-md-6">
								 {!! Form::text('unit',null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('unit')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Order Quantity<strong class="requird">*</strong></label>
							<div class="col-md-6">
								 {!! Form::text('order_quantity',null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('order_quantity')}}</p>
							 @endif
					    </div>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label"><td>Total Sqmt</td><strong class="requird">*</strong></label>
							<div class="col-md-6">
								 {!! Form::text('total_sqmt', null,array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('total_sqmt')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Quality Per Sqmt<strong class="requird">*</strong></label>
							<div class="col-md-6">
								 {!! Form::text('quality_per_sqmt',null ,array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('quality_per_sqmt')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Order Date<strong class="requird">*</strong></label>
							<div class="col-md-6">
								 {!! Form::text('order_date',null, array('class' => 'form-control datepicker','autocomplete'=> 'off',)) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('order_date')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Delivery Date<strong class="requird">*</strong></label>
							<div class="col-md-6">
								 {!! Form::text('delivery_date',null, array('class' => 'form-control datepicker','autocomplete'=> 'off',)) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('delivery_date')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Remarks</label>
							<div class="col-md-6">
								 {!! Form::textarea('remarks',null, array('class' => 'form-control', 'rows'=>"10", 'cols'=>"25")) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('remarks')}}</p>
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
<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-3d',
    autocomplete:true
});
});

</script>

			
@endsection