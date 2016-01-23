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
				     <h3> Edit Vendor</h3>
					<!--  <div style='margin-top: 20px;' id="jqxgrid">
	            
	                 </div> -->
	                 @if(Session::has('vendor_created'))
	                 <div>
	                 
	                 <p style="color:green"> {{Session::get('vendor_created')}}</p>
	                 </div>
	                 @endif
	                <div id="create-order" style="display:block; margin-top:25px;">
					
					    {!!Form::model($vendor,array('url' => "/admin/editvendor/".$vendor->id, 'method' => 'post'))!!}
						

						<div class="form-group">
							<label class="col-md-4 control-label">Vendor Name<strong class="requird">*</strong></label>
							<div class="col-md-6">
								 {!! Form::text('vendor_name',null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('vendor_name')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Vendor Email<strong class="requird">*</strong></label>
							<div class="col-md-6">
								 {!! Form::text('vendor_email', null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('vendor_email')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Vendor Contact<strong class="requird">*</strong></label>
							<div class="col-md-6">
								 {!! Form::text('vendor_contact', null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('vendor_contact')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Alternet Contact</label>
							<div class="col-md-6">
								 {!! Form::text('vendor_alternet_contact' ,null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('vendor_alternet_contact')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Vendor Address</label>
							<div class="col-md-6">
								 {!! Form::text('vendor_address' ,null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('vendor_address')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Pin Code</label>
							<div class="col-md-6">
								 {!! Form::text('vendor_pin_code' ,null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('vendor_pin_code')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Country</label>
							<div class="col-md-6">
								 {!! Form::text('country' ,null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('country')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">State</label>
							<div class="col-md-6">
								 {!! Form::text('state' ,null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('state')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">City</label>
							<div class="col-md-6">
								 {!! Form::text('city' ,null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('city')}}</p>
							 @endif
					    </div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">About<strong class="requird">*</strong></label>
							<div class="col-md-6">
								 {!! Form::textarea('about_vendor', null, array('class' => 'form-control')) !!}
							<br>
							 @if($errors->has())
							 <p class="requird">{{$errors->first('about_vendor')}}</p>
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