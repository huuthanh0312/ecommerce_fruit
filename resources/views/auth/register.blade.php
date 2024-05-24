<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
	data-assets-path="{{asset('backend/')}}" data-template="vertical-menu-template-free">

<head>
	<meta charset="utf-8" />
	<meta name="viewport"
		content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

	<title>Thanh Fruit</title>

	<meta name="description" content="" />

	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="{{asset('backend/assets/img/favicon/favicon.ico')}}" />

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link
		href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
		rel="stylesheet" />

	<!-- Icons. Uncomment required icon fonts -->
	<link rel="stylesheet" href="{{asset('backend/assets/vendor/fonts/boxicons.css')}}" />

	<!-- Core CSS -->
	<link rel="stylesheet" href="{{asset('backend/assets/vendor/css/core.css')}}"
		class="template-customizer-core-css" />
	<link rel="stylesheet" href="{{asset('backend/assets/vendor/css/theme-default.css')}}"
		class="template-customizer-theme-css" />
	<link rel="stylesheet" href="{{asset('backend/assets/css/demo.css')}}" />

	<!-- Vendors CSS -->
	<link rel="stylesheet" href="{{asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

	<!-- Page CSS -->
	<!-- Page -->
	<link rel="stylesheet" href="{{asset('backend/assets/vendor/css/pages/page-auth.css')}}" />
	<!-- Helpers -->
	<script src="{{asset('backend/assets/vendor/js/helpers.js')}}"></script>
	<script src="{{asset('backend/assets/js/config.js')}}"></script>
	{{-- Toastr --}}
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
</head>

<body>
	<!-- Content -->

	<div class="container-xxl">
		<div class="authentication-wrapper authentication-basic container-p-y">
			<div class="authentication-inner">
				<!-- Register -->
				<div class="card">
					<div class="card-body">
						<!-- Logo -->
						<div class="app-brand justify-content-center pt-0">
							<a href="{{url('/')}}" class="app-brand-link gap-2">
								<h2 class="demo text-success fw-bolder">Thanh Fruit Register</h2>
							</a>
						</div>
						<p class="mb-2">Welcome to Thanh Fruit! 👋</p>
						<form class="mb-3" method="POST" action="{{ route('register') }}">
							@csrf
							<div class="mb-3">
								<label for="name" class="form-label">Name</label>
								<input type="name" class="form-control @error('name') is-invalid @enderror" id="name"
									name="name" value="{{old('name')}}" placeholder="Enter your name " autofocus />
								@error('name')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="mb-3">
								<label for="email" class="form-label">Email</label>
								<input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
									name="email" value="{{old('email')}}" placeholder="Enter your email " />
								@error('email')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="mb-3 form-password-toggle">
								<div class="d-flex justify-content-between">
									<label class="form-label" for="password">Password</label>
									
								</div>
								<div class="input-group input-group-merge">
									<input type="password" id="password" class="form-control" name="password"
										placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
										aria-describedby="password" />
									<span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
									@error('password')
										<span class="text-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="mb-3 form-password-toggle">
								<div class="d-flex justify-content-between">
									<label class="form-label" for="password">Confirm password</label>
								</div>
								<div class="input-group input-group-merge">
									<input type="password" id="password" class="form-control" name="password_confirmation"
										placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
										aria-describedby="password" />
									<span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
									@error('password_confirmation')
									<span class="text-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="mb-3">
								<button type="submit" class="btn btn-primary d-grid w-100">Register</button>
							</div>
							<div class="d-flex justify-content-center links">
								Already have an account?<a href="{{route('login')}}">Sign In</a>
							</div>
							
						</form>


					</div>
				</div>
				<!-- /Register -->

			</div>
		</div>
	</div>

	<!-- / Content -->

	<div class="buy-now">

		<a href="{{url('/')}}" class="btn btn-success m-2 btn-buy-now">Home Thanh Fruit</a>
	</div>

	<!-- Core JS -->
	<!-- build:js assets/vendor/js/core.js -->
	<script src="{{asset('backend/assets/vendor/libs/jquery/jquery.js')}}"></script>
	<script src="{{asset('backend/assets/vendor/libs/popper/popper.js')}}"></script>
	<script src="{{asset('backend/assets/vendor/js/bootstrap.js')}}"></script>
	<script src="{{asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

	<script src="{{asset('backend/assets/vendor/js/menu.js')}}"></script>
	<!-- endbuild -->

	<!-- Vendors JS -->

	<!-- Main JS -->
	<script src="{{asset('backend/assets/js/main.js')}}"></script>

	<!-- Page JS -->
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