<head>
	<meta charset="utf-8" />
	<title>@yield('title', '--') - {{ setting('app_name',locale()) }}</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta name="keywords" content="@yield('meta_keywords','classicads, classified, ads, classified ads, listing, business, directory, jobs, marketing, portal, advertising, local, posting, ad listing, ad posting,')">
	<meta name="description" content="@yield('meta_description', strip_tags(setting('how_its_work', locale() ) ) )">
	<link rel="canonical" href="{{url()->current()}}"/>
	@yield("seo_meta")

	
	<!--=====================================
				CSS LINK PART START
	=======================================-->
	<!-- FAVICON -->
	<link rel="icon" href="{{url(setting('favicon')?? '')}}">

	<!-- FONTS -->
	<link rel="stylesheet" href="/frontend/fonts/flaticon/flaticon.css">
	<link rel="stylesheet" href="/frontend/fonts/font-awesome/fontawesome.css">

	<!-- VENDOR -->
	<link rel="stylesheet" href="/frontend/css/vendor/slick.min.css">

	<link rel="stylesheet" href="/frontend/css/vendor/bootstrap.min.css">
	
	<!-- CUSTOM -->
	<link rel="stylesheet" href="/frontend/css/custom/main-{{is_rtl()}}.css">

	@yield("custom_css")
	<!--=====================================
				CSS LINK PART END
	=======================================-->
	
	<link rel="stylesheet" href="/admin/assets/global/plugins/bootstrap-toastr/toastr.min.css">

	@if(locale() == "ar")
		<link rel="stylesheet" href="/admin/assets/global/plugins/bootstrap-toastr/toastr-rtl.min.css">

	@endif

	<link rel="shortcut icon" href="{{ setting('favicon') ? url(setting('favicon')) : '/frontend/images/logo.png' }}" />

	<style>
		.isFavourit{
			background-color: var(--primary) !important;
			color:#fff !important;
		}

		.custom-img {
			object-fit: contain
		}
		.custom-img-cover {
			object-fit: cover
		}

	</style>

	

	@yield('css')

</head>
