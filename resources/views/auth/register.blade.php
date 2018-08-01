@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="limiter">
	<div class="container-login100">
		<div class="wrap-login100">
			<div class="login100-pic js-tilt" data-tilt>
				<a href="{{ url('/') }}"><img src="{{ asset('images/img-01.png') }}" alt="IMG"></a>
			</div>

			<form method="POST" action="{{ route('register') }}" class="login100-form validate-form">
            @csrf
                <span class="login100-form-title">
					Create an account
				</span>

				<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
					<input class="input100" type="text" name="email" placeholder="Email">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-envelope" aria-hidden="true"></i>
					</span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Name is required">
					<input class="input100" type="text" name="username" placeholder="Username">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-user" aria-hidden="true"></i>
					</span>
				</div>

                <div class="wrap-input100 validate-input" data-validate = "Password is required">
					<input class="input100" type="password" name="password" placeholder="Password">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-lock" aria-hidden="true"></i>
					</span>
				</div>

                <div class="wrap-input100 validate-input" data-validate = "Password is required">
					<input class="input100" type="password" name="password_confirmation" placeholder="Confirm Password">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-lock" aria-hidden="true"></i>
					</span>
				</div>

				<div class="container-login100-form-btn">
					<button class="login100-form-btn">
						Sign Up
					</button>
				</div>

				<div class="text-center p-t-12">
                    <span class="txt1">
						Already registered with us? Please
					</span>
					<a class="txt2" href="{{ route('login') }}">
						Login
					</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
