<html>
	<!-- Master template -->
	<head>
		@yield('header')
	</head>
	<body>
		<nav>
			@yield('navigation')
		</nav>
		@yield('parallax-container')
		@yield('content')
		@yield('messages')
		@yield('footer')
		@yield('scripts')
	</body>
</html>

