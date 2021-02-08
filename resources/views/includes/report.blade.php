<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>@yield('title') | MahirApp</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="/deskapp/vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/deskapp/vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/deskapp/vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="/deskapp/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="/deskapp/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="/deskapp/src/plugins/sweetalert2/sweetalert2.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="/deskapp/src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="/deskapp/vendors/styles/style.css">

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
				MahirApp - Build with <i class="icon-copy ion-heart" style="color: salmon"></i> by <a style="color: salmon" href="https://www.instagram.com/adine_pamungkas" target="_blank">Adi Pamungkas</a>.
			</div>
		</div>
	</div>
	@yield('addon-script')
	<!-- js -->
	<script src="/deskapp/vendors/scripts/core.js"></script>
	<script src="/deskapp/vendors/scripts/script.min.js"></script>
	<script src="/deskapp/vendors/scripts/process.js"></script>
	<script src="/deskapp/vendors/scripts/layout-settings.js"></script>
	@yield('script')
</body>
</html>