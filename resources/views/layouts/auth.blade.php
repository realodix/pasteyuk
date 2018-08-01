<!DOCTYPE html>
<html lang="en">
<head>
<title>Paste Yuk! - @yield('title')</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/fontawesome/css/all.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/auth.css') }}">
</head>

<body>

@yield('content')

<script src="{{ asset('vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('vendor/popper.js/popper.js-1.14.3.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('vendor/tilt/tilt.jquery.min.js') }}"></script>

<script >
$('.js-tilt').tilt({
	scale: 1.1
})
</script>

</body>
</html>
