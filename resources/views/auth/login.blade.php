@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="limiter">
	<div class="container-login100">
		<div class="wrap-login100">
			<div class="login100-pic js-tilt" data-tilt>
				<a href="{{ url('/') }}"><img src="{{ asset('images/img-01.png') }}" alt="IMG"></a>
			</div>

			<form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
            @csrf
                <span class="login100-form-title">
					Member Login
				</span>

				@if(session()->has('login_error'))
					<div class="p-3 mb-2 bg-warning text-dark">
						{{ session()->get('login_error') }}
					</div>
				@endif

				<div class="wrap-input100 validate-input">
					<input class="input100" type="text" name="identity" placeholder="Username or Email">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-user" aria-hidden="true"></i>
					</span>
				</div>
				@if ($errors->has('identity'))
					<p class="text-danger">{{ $errors->first('identity') }}</p>
				@endif

				<div class="wrap-input100 validate-input">
					<input class="input100" type="password" name="password" placeholder="Password">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-lock" aria-hidden="true"></i>
					</span>
				</div>
				@if ($errors->has('password'))
					<p class="text-danger">{{ $errors->first('password') }}</p>
				@endif

				<div class="container-login100-form-btn">
					<button class="login100-form-btn">
						Login
					</button>
				</div>

				<div class="text-center p-t-12">
					<span class="txt1">
						Forgot
					</span>
					<a class="txt2" href="{{ route('password.request') }}">
						Password?
					</a>
				</div>

				<div class="text-center p-t-136">
					<a class="txt2" href="{{ route('register') }}">
						Create your Account
						<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
					</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
