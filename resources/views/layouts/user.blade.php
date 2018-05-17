<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Welcome to Bus Service</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="/css/app.css" rel="stylesheet">
<link href="{{ url("css/frontendstyle.css") }}" rel="stylesheet" type="text/css" media="all">
<link href="{{ url("css/megamenu.css") }}" rel="stylesheet" type="text/css" media="all">
	<script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
	</script>
    </head>

    <body>
        <div class="header-top">
	   <div class="wrap">
			  <div class="header-top-left">
			  	   
   				    <div class="clear"></div>
   			 </div>
			 <div class="cssmenu">
				<ul>
					@if (!Auth::guest())
						<li><a href="#">Welcome {{ Auth::user()->name }}</a></li> |
						<li><a href="{{ url('/logout') }}">Logout</a></li>
					@else
						<li><a href="/login">Log In</a></li>
					@endif
				</ul>
			</div>
			<div class="clear"></div>
 		</div>
	</div>
	<div class="header-bottom">
	    <div class="wrap">
			<div class="header-bottom-left">
				<div class="logo">
					<a href="/">Bus Service</a>
				</div>
				<div class="menu">
	            <ul class="megamenu skyblue">
			<li class="grid" style="display: inline-block;"><a href="/">Home</a></li>
			<li style="display: inline-block;"><a class="color4" href="#">categories</a></li>
				<li style="display: inline-block;"><a class="color5" href="#">customer support</a></li>
			</ul>
			</div>
		</div>
	   <div class="header-bottom-right">
	  <div class="tag-list" style="float:right">
            <ul class="icon1 sub-icon1 profile_img __web-inspector-hide-shortcut__">
			<li><a class="active-icon c2" href="{{ url("/viewcart") }}"> </a>
				
			</li>
		</ul>
	  </div>
    </div>
     <div class="clear"></div>
     </div>
	</div>
      @yield('content')
     <div class="footer">
		<div class="footer-bottom">
			<div class="wrap">
	             <div class="copy">
			        <p>© 2018 Bus Service. All rights reserved</p>
		         </div>
				<div class="f-list2">
				 <ul>
					<li class="active"><a href="#">About Us</a></li> |
					<li><a href="#">Terms &amp; Conditions</a></li> |
					<li><a href="#">Contact Us</a></li> 
				 </ul>
			    </div>
			    <div class="clear"></div>
		      </div>
	     </div>
	</div>
		<script src="/js/user_app.js"></script>
		@yield('scripts')
  </body>
  </html>
