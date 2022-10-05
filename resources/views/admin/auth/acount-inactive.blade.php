<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/favicon.ico">

    <title>@lang('site.site name')</title>
  
	
    <link rel="stylesheet" href="{{ URL::asset('assets/app-assets/css/vendors_css.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('assets/app-assets/css/style.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('assets/app-assets/css/skin_color.css') }}">

</head>
<body class="hold-transition">
	
	<section class="error-page h-p100 bg-gradient-info theme-primary">
		<div class="container h-p100">
		  <div class="row h-p100 align-items-center justify-content-center text-center">
			  <div class="col-lg-7 col-md-10 col-12">
				  <div class="b-double border-white rounded">
					  <h1 class="text-white font-size-180 font-weight-bold error-page-title"> <i class="fa fa-gear fa-spin"></i></h1>
					  <h1 class="text-white">@lang('site.your account is inactive')</h1>
					  {{-- <h3 class="text-white">We're sorry for the inconvenience.</h3> --}}
					  {{-- <h4 class="mb-25 text-white">Please check back later.</h4>	 --}}
				  </div>
			  </div>				
		  </div>
		</div>
	</section>



    <script src="{{ URL::asset('assets/app-assets/js/vendors.min.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/icons/feather-icons/feather.min.js') }}"></script>
</body>
</html>
