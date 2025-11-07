<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

             <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <!-- Global stylesheets -->
	<link href="{!! asset('assets/fonts/inter/inter.css') !!}" rel="stylesheet" type="text/css">
	<link href="{!! asset('assets/icons/phosphor/styles.min.css') !!}" rel="stylesheet" type="text/css">
	<link href="{!! asset('css/ltr/all.min.css') !!}" id="stylesheet" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
    <script src="{!! asset('assets/js/jquery/jquery.min.js') !!}"></script>
    <script src="{!! asset('assets/js/vendor/tables/datatables/datatables.min.js') !!}"></script>
	<script src="{!! asset('assets/js/vendor/tables/datatables/extensions/buttons.min.js') !!}"></script>

	<script src="{!! asset('assets/demo/demo_configurator.js') !!}"></script>
	<script src="{!! asset('assets/js/bootstrap/bootstrap.bundle.min.js') !!}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{!! asset('assets/js/vendor/visualization/d3/d3.min.js') !!}"></script>
	<script src="{!! asset('assets/js/vendor/visualization/d3/d3_tooltip.js') !!}"></script>

	<script src="{!! asset('js/app.js') !!}"></script>
    <script src="{!! asset('assets/demo/pages/datatables_basic.js') !!}"></script>

	<script src="{!! asset('assets/demo/pages/dashboard.js') !!}"></script>
	<script src="{!! asset('assets/demo/charts/pages/dashboard/streamgraph.js') !!}"></script>
	<script src="{!! asset('assets/demo/charts/pages/dashboard/sparklines.js') !!}"></script>
	<script src="{!! asset('assets/demo/charts/pages/dashboard/lines.js') !!}"></script>
	<script src="{!! asset('assets/demo/charts/pages/dashboard/areas.js') !!}"></script>
	<script src="{!! asset('assets/demo/charts/pages/dashboard/donuts.js') !!}"></script>
	<script src="{!! asset('assets/demo/charts/pages/dashboard/bars.js') !!}"></script>
	<script src="{!! asset('assets/demo/charts/pages/dashboard/progress.js') !!}"></script>
	<script src="{!! asset('assets/demo/charts/pages/dashboard/heatmaps.js') !!}"></script>
	<script src="{!! asset('assets/demo/charts/pages/dashboard/pies.js') !!}"></script>
	<script src="{!! asset('assets/demo/charts/pages/dashboard/bullets.js') !!}"></script>
	<!-- /theme JS files -->




    </head>
    <body>
            @include('layouts.mainNavBar')
            <!-- Page container -->


		<!-- Page content -->
		<div class="page-content">
            @include('layouts.navigation')
            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset
            <!-- Main content -->
            <div class="content-wrapper">
                <!-- Inner content -->
                <div class="content-inner">
                    @include('layouts.header')
                    {{ $slot }}
                </div>
                @include('layouts.footer')
            </div>
			<!-- /inner content -->
        </div>
		<!-- /page content -->
    </body>
</html>
