@extends('frontend.main_master')
@section('main')
<link rel="stylesheet" href="{{asset('backend/assets/vendor/fonts/boxicons.css')}}" />

<!-- Helpers -->
<script src="{{asset('backend/assets/vendor/js/helpers.js')}}"></script>

<!-- Single Page Header start -->
<div class="container-fluid page-header">
</div>
<!-- Single Page Header End -->
<div class="container-fluid py-3">
	<div class="container ">
		<!-- Logo -->
		<div class="row justify-content-center align-items-center">
			<div class="col-lg-6 p-5 pt-4 shadow bg-white rounded">
				<div class="text-center pb-2">
					<a href="{{url('/')}}" class="app-brand-link">
						<h2 class="demo text-success fw-bolder">Thanh Fruit Login</h2>
					</a>
				</div>
				<p class="mb-2">Welcome to Thanh Fruit! 👋</p>
				<form class="mb-2" method="POST" action="{{ route('login') }}">
					@csrf
					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
							value="{{old('email')}}" placeholder="Enter your email " autofocus />
						@error('email')
						<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="mb-3 form-password-toggle">
						<div class="d-flex justify-content-between">
							<label class="form-label" for="password">Password</label>
							@if (Route::has('password.request'))
							<div class="col-md-6 text-end">
								<a href="{{ route('password.request') }}"><small>Forgot Password ?</small></a>
							</div>
							@endif
						</div>
						<div class="input-group input-group-merge">
							<input type="password" id="password" class="form-control" name="password"
								placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
								aria-describedby="password" />
							<span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
						</div>
						@error('password')
						<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="mb-3">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="remember-me" name="remember" />
							<label class="form-check-label" for="remember-me"> Remember Me </label>
						</div>
					</div>
					<div class="mb-3">
						<button type="submit" class="btn btn-primary d-grid w-100">Sign in</button>
					</div>
					<div class="d-flex justify-content-center links">
						Don't have an account?<a href="{{route('register')}}">Register</a>
					</div>
					<hr>
					<div class="mb-3">
						<button type="button" id="click" class="btn btn-dark d-grid w-100 text-white">
							Tài Khoản Nhà Tuyển Dụng</button>
					</div>
					<div class="row d-none mt-2" id="account">
						<div class="col-lg-12 pt-2 text-center border-top border-success">
							<h6>Đăng Nhập Tài Khoản</h6>
							<p> Email : <span class="text-primary">hr@gmail.com</span></p>
							<p> Password : <span class="text-primary">Hr@12345</span></p>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<!-- / Content -->
</div>
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
<script src="{{asset('backend/assets/js/main.js')}}"></script>

@endsection