<!DOCTYPE html>
<html lang="en">
<head>
    @include('Dashboard.component.head')
    @yield('head')

</head>
<body>
    <div id="preloader">
		<div class="lds-ripple">
			<div></div>
			<div></div>
		</div>
    </div>
    <div id="main-wrapper">

        @include('Dashboard.component.navigation')
        <div class="content-body">
            <!-- row -->
			@yield('content')
        </div>
		
        @include('Dashboard.component.footer')


	</div>
    @include('Dashboard.component.script')
    @yield('script')
</body>
</html>