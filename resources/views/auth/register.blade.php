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
					<a href="{{url('/')}}" class="app-brand-link gap-2">
						<h2 class="demo text-success fw-bolder">Thanh Fruit Register</h2>
					</a>
				</div>
				<p class="mb-2">Welcome to Thanh Fruit! 👋</p>
				<form class="mb-3" method="POST" action="{{ route('register') }}">
					@csrf
					<div class="mb-3">
						<label for="name" class="form-label">Name</label>
						<input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
							value="{{old('name')}}" placeholder="Enter your name " autofocus />
						@error('name')
						<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
							value="{{old('email')}}" placeholder="Enter your email " />
						@error('email')
						<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="mb-3 form-password-toggle">
						<div class="d-flex justify-content-between">
							<label class="form-label" for="password">Password</label>

						</div>
						<div class="input-group input-group-merge">
							<input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
								name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
								aria-describedby="password" />
							<span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
						</div>
						@error('password')
						<span class="text-danger">{{ $message }}</span>
						@enderror
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
	</div>
</div>
</div>
</div>
<!-- / Content -->
</div>
<script src="{{asset('backend/assets/js/main.js')}}"></script>

@endsection