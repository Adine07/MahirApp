<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>@yield('title') | MahirApp</title>

	@include('includes.header')
</head>
<body>

	@include('includes.navbar')

	@include('includes.sidebar')
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				@yield('content')
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				MahirApp - Build with <i class="icon-copy ion-heart" style="color: salmon"></i> by <span style="color: salmon">Anak Magang</span>.
			</div>
		</div>
	</div>
	@yield('addon-script')
	@include('includes.footer')
	@yield('script')
</body>
</html>