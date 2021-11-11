<html lang="en">
<head>
<title>User Landing Page</title>
	
	<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
    <link rel="stylesheet" href="/css/style.css">

    <link  rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="/css/user.css" rel="stylesheet">

 
<style>

body {
    color: #566787;
    font-family: 'Varela Round', sans-serif;
    font-size: 13px;
}
</style>

</head>
<body class="backg">

<div class="container">
	<div class="header navbar bdrop">
	
				<img src="/images/logo_plmun.png" class="logo">
				<nav>
					<ul>
					<li><a>Hello,  {{ $user['fname'] }}!</a></li>
										@if(Auth::user()->role==2)
						<li><a href="{{route('manager.dashboard')}}">Home </a></li>
						<li><a href="{{route('manager.guides')}}">View Guides </a></li>
					@else
					<li><a href="{{route('user.dashboard')}}">Home </a></li>
					@endif
						<li> <a class="dropdown-item" href="{{ route('logout') }}"
										onclick="event.preventDefault();
														document.getElementById('logout-form').submit();">
											{{ __('Logout') }}
										</a><form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
											@csrf 
						</form></li>
					</ul>
				</nav>
	</div>

    <div>
		
			<form action="{{ route('web.search') }}" method="GET">	
					<div class="form-group">
						<input type="text" class="form-control" name="query" placeholder="Search here....." value="{{ request()->input('query') }}">
						<span class="text-danger">@error('query'){{ $message }} @enderror</span>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Search</button>
					</div>
			</form>
    @yield('content')
    </div>
	<br>
	<br>
	<br>
	<br>
</div>
	


</body>
</html>