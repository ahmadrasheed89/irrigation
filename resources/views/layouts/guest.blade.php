<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>


	<!-- Global stylesheets -->
	<link href="{!! asset('assets/fonts/inter/inter.css') !!}" rel="stylesheet" type="text/css">
	<link href="{!! asset('assets/icons/phosphor/styles.min.css') !!}" rel="stylesheet" type="text/css">
	<link href="{!! asset('css/ltr/all.min.css') !!}" id="stylesheet" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{!! asset('assets/demo/demo_configurator.js') !!}"></script>
	<script src="{!! asset('assets/js/bootstrap/bootstrap.bundle.min.js') !!}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{!! asset('js/app.js') !!}"></script>
	<!-- /theme JS files -->

    </head>
    <body>
        @include('layouts.guestNavigation')
            <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Inner content -->
                <div class="content-inner">
                {{ $slot }}
                @include('layouts.footer')
                 </div>

            </div>
			<!-- /inner content -->
        </div>
		<!-- /page content -->


    </body>
</html>
