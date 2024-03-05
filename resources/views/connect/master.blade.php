<!DOCTYPE html>
<html>
<head>
	<title>MyCms - @yield('title')</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

	<link rel="stylesheet" href="{{ url('/static/css/connect.css?v='.time()) }}">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://kit.fontawesome.com/ff2ccf8f7c.js" crossorigin="anonymous"></script>


</head>
<body>


	




	@section('content')
	Hola esto es master blade
	@show
</body>
</html>

