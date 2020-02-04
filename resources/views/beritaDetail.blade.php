
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Consolution - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('depan/css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('depan/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('depan/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('depan/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('depan/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('depan/css/aos.css')}}">
    <link rel="stylesheet" href="{{asset('depan/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('depan/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('depan/css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('depan/css/style.css')}}">
  </head>
  <body>
	  <nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container d-flex align-items-center">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav mr-auto">
	        	<li class="nav-item active"><a href="{{Route('depan')}}" class="nav-link pl-0">Home</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->

    <section class="ftco-section bg-light">
		<div class="container">
            <img src="{{asset('/img/berita/'.$berita->foto)}}" alt="" style="width:1110px !important; height:600px !important;">
            <h1 style="font-size:40px">{{$berita->judul}}</h1>
            @php
                $isi = $berita->isi;
            @endphp
            <p style="text-align:justify">{!! $isi !!}</p>
		</div>
    </section>



    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-12 col-lg-12" style="text-align:center;">
            <div class="ftco-footer-widget mb-5">
            	<h2 class="ftco-heading-2">Mempunyai Pertanyaan ?</h2>
              <p><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></p>
	            <p><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></p>
	            <p><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
      </div>
    </footer>



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="{{asset('depan/js/jquery.min.js')}}"></script>
  <script src="{{asset('depan/js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{asset('depan/js/popper.min.js')}}"></script>
  <script src="{{asset('depan/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('depan/js/jquery.easing.1.3.js')}}"></script>
  <script src="{{asset('depan/js/jquery.waypoints.min.js')}}"></script>
  <script src="{{asset('depan/js/jquery.stellar.min.js')}}"></script>
  <script src="{{asset('depan/js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('depan/js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{asset('depan/js/aos.js')}}"></script>
  <script src="{{asset('depan/js/jquery.animateNumber.min.js')}}"></script>
  <script src="{{asset('depan/js/scrollax.min.js')}}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="{{asset('depan/js/google-map.js')}}"></script>
  <script src="{{asset('depan/js/main.js')}}"></script>

  </body>
</html>
