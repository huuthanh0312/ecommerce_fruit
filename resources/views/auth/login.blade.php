<!DOCTYPE html>
<html>

<head>
	<title>Thanh Fruit</title>
	<!--Made with love by Mutiullah Samim -->

	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
		integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
		integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"
		id="bootstrap-css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!------ Include the above in your HEAD tag ---------->
	{{-- Toastr --}}
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/login.css')}}">
</head>

<body>
	<div class="container">
		<a href="{{url('/')}}" class="btn btn-outline-success">Go Home Thanh Fruit</a>

		<div class="d-flex justify-content-center h-120">
			<div class="card">
				<div class="card-header">
					<h3>Login Thanh Fruit</h3>
					<div class="d-flex justify-content-end social_icon ">
						<span><i class="fab fa-facebook-square"></i></span>
						<span><i class="fab fa-google-plus-square"></i></span>

					</div>
				</div>
				<div class="card-body">
					<form method="POST" action="{{ route('login') }}">
						@csrf
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-envelope"></i></span>
							</div>
							<input type="email" class="form-control" name="email" placeholder="Email"
								value="{{old('email')}}" required autofocus autocomplete="email">
							@error('email')
							<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control" placeholder="Password" required>
						</div>

						<div class="row pt-4">
							<div class="col-md-6 remember">
								<input type="checkbox" id="remember_me" name="remember">
								<span>Remember Me</span>
							</div>
							<div class="col-md-6"><input type="submit" value="Login" class="btn float-right login_btn">
							</div>

						</div>
					</form>
				</div>
				<div class="card-footer">
					<div class="d-flex justify-content-center links">
						Don't have an account?<a href="{{route('register')}}">Register</a>
					</div>
					<div class="d-flex justify-content-center">
						@if (Route::has('password.request'))
						<a href="{{ route('password.request') }}">Forgot your password?</a>
						@endif
					</div>
				</div>
			</div>
		</div>
		<br>
		<br>

		<div class="row  text-center fixed">
			<div class="col-md-12 text-center text-white">
				
				<button id="click" class="btn btn-dark m-2 text-white">Tài Khoản Nhà Tuyển Dụng</button>	
				<div class="bg-dark  d-none" id="account">
					<br>
					<h6 class="mb-2">Đăng Nhập Tài Khoản</h6>
					<p class="card-text"> Email : <span class="text-primary">hr@gmail.com</span></p>
					<p class="card-text"> Password : <span class="text-primary">Hr@12345</span></p>
				</div>
			</div>

		</div>

	</div>
	<!-- Copyright Start -->
	<div class="container-fluid copyright bg-light">
		<div class="container">
	
		</div>
	</div>
	<!-- Copyright End -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<!--Notification-->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

	<script>
		$(document).delegate("#click","click",function(){
			var check = $('#account').hasClass('d-none');
			if(check == false){
				$('#account').addClass('d-none');
				
			} else {
				$('#account').removeClass('d-none');
				
			}	
		});
	</script>
	<script>
		@if(Session::has('message'))     
        var type = "{{ Session::get('alert-type','info') }}"
        switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;
        
            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;
        
            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;
        
            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break; 
        }
    @endif 
	</script>
	
</body>

</html>