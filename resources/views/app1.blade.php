

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Yarn</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/plugin/datepicker/css/datepicker.css') }}" rel="stylesheet">
	<link href="{{ asset('/plugin/jqwidgets/styles/jqx.base.css') }}" rel="stylesheet">
	<link href="{{ asset('/plugin/jqwidgets/styles/jqx.metro.css') }}" rel="stylesheet">
	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style type="text/css">
     .nathv
     {
     	list-style-type: none;
     }
      .nathv li
     {
     	padding: 10px;
     }
     .requird
     {
     	color:red;
     }
	</style>
	<!-- Scripts -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		 <script type="text/javascript" type="text/javascript" src="{{ asset('/js/jquery.ajaxq-0.0.1.js') }}"></script> 
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{ asset('/plugin/datepicker/js/bootstrap-datepicker.js')}}"></script>
	<script type="text/javascript" src="{{ asset('/plugins/jqwidgets/globalization/globalize.js')}}"></script>
    <script  type="text/javascript" src="{{ asset('/plugins/jqwidgets/jqx-all.js')}}"></script> 
	<script type="text/javascript" src="{{ asset('/plugins/jqwidgets/function.js')}}"></script>
	
	
	
	<script src="{{ asset('/js/admin_new.js')}}"></script>

   
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nathv navbar-nav">
				@if(Auth::check())
					@if(Auth::user()->is_super == 1)

					<li><a  href="{{ url('/admin/orders') }}">Order</a></li>
					<li><a  href="{{ url('/admin/showorders') }}">Order List</a></li>
					<li><a  href="{{ url('/admin/vendor') }}">Add Vendor</a></li>
					<li><a  href="{{ url('/admin/vendorlist') }}">vendor List</a></li>
					<li><a  href="{{ url('/store/additem') }}">Add Item</a></li>
					<li><a  href="{{ url('/store/viewstore') }}">View Store</a></li>
					@endif
				@endif

					<!-- <li><a href="{{ url('/') }}">Home</a></li> -->
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	
</body>
</html>
