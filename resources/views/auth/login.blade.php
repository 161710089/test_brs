<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{!! asset('login2/images/icons/IC-J.png') !!}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{!! asset('login2/vendor/bootstrap/css/bootstrap.min.css') !!}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{!! asset('login2/fonts/font-awesome-4.7.0/css/font-awesome.min.css') !!}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{!! asset('login2/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') !!}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{!! asset('login2/fonts/iconic/css/material-design-iconic-font.min.css') !!}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{!! asset('login2/vendor/animate/animate.css') !!}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{!! asset('login2/vendor/css-hamburgers/hamburgers.min.css') !!}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{!! asset('login2/vendor/animsition/css/animsition.min.css') !!}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{!! asset('login2/vendor/select2/select2.min.css') !!}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{!! asset('login2/vendor/daterangepicker/daterangepicker.css') !!}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{!! asset('login2/css/util.css') !!}">
	<link rel="stylesheet" type="text/css" href="{!! asset('login2/css/main.css') !!}">
<!--===============================================================================================-->
<!-- toast CSS -->
<link href="{!! asset('admin/plugins/bower_components/toast-master/css/jquery.toast.css') !!}" rel="stylesheet">	
</head>
<style>
	@media screen and (max-width: 600px) {
	
	
	}
	</style>
<body style="background-image: linear-gradient(to right bottom, #fbc31e, #fbb71c, #faac1c, #f9a01d, #f79520);">
	
	<div  class="limiter">
		<div class="container-login100">
			<div class="login100-more" style="background-image: url('../admin/plugins/images/logo_so.png'); background-size: 600px 408px; top: -55px;">
			</div>

			<!-- <p style="color:#ffffff;  position: absolute; z-index: 2; text-align:center; top: 75%; left:15%;">
                Aplikasi Sederhana berbasis website.  
            </p>	
			 -->
			<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
                <form method="POST" action="{{ route('login') }}">
                        @csrf
					<span class="login100-form-title p-b-8">
					
                <p style="color:#939598;font-size: 25px; ">Selamat Datang di</p>
				<h2 style="color:#fbbe1d">Aplikasi Sales Order</h2>
				<br>
					</span>
					<div class="wrap-input100 validate-input" data-validate="Email is required">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" placeholder="email...">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="*************">
						<span class="focus-input100"></span>
					</div>
					<div class="container-login100-form-btn ">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							
							<button type="submit" class="login100-form-btn">
								Login
							</button>
						</div>
					</div>
                    Belum punya akun? daftar
                    <a href="{{route('register')}}" style='color:blue; font-size:17px;'>disini.</a>

				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="{!! asset('login2/vendor/jquery/jquery-3.2.1.min.js') !!}"></script>
<!--===============================================================================================-->
	<script src="{!! asset('login2/vendor/animsition/js/animsition.min.js') !!}"></script>
<!--===============================================================================================-->
	<script src="{!! asset('login2/vendor/bootstrap/js/popper.js') !!}"></script>
	<script src="{!! asset('login2/vendor/bootstrap/js/bootstrap.min.js') !!}"></script>
<!--===============================================================================================-->
	<script src="{!! asset('login2/vendor/select2/select2.min.js') !!}"></script>
<!--===============================================================================================-->
	<script src="{!! asset('login2/vendor/daterangepicker/moment.min.js') !!}"></script>
	<script src="{!! asset('login2/vendor/daterangepicker/daterangepicker.js') !!}"></script>
<!--===============================================================================================-->
	<script src="{!! asset('login2/vendor/countdowntime/countdowntime.js') !!}"></script>
<!--===============================================================================================-->
	<script src="{!! asset('login2/js/main.js') !!}"></script>
	<script src="{!! asset('admin/plugins/bower_components/toast-master/js/jquery.toast.js') !!}"></script>

	<script>
		 @php
      $msg = Session::get('msg');
      $msgs = json_decode($msg);
     @endphp
     console.log('{{$msg}}');
     @if(!empty($msg))
  	    $.toast({
  				heading: 'Notif!',
  				text: '{{$msgs->pesan}}',
  				position: 'top-right',
  				loaderBg: '#fff',
  				icon: '{{$msgs->type}}',
  				hideAfter: 10000,
  				stack: 6
  			});
   	  @endif
	</script>
</body>
</html>
