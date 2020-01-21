
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Aplikasi Pengelolaan data berkala guru</title>
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
	        	<li class="nav-item"><a href="#" class="nav-link">Tentang Kami</a></li>
	        	<li class="nav-item"><a href="{{Route('beritaAll')}}" class="nav-link">Berita</a></li>
	          <li class="nav-item"><a href="{{Route('login')}}" class="nav-link">login</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
    
    <section class="home-slider owl-carousel">
      <div class="slider-item" style="background-image:url(depan/images/bg_1.jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate">
          	<span class="subheading">Aplikasi Pengelolaan</span>
            <h1 class="mb-4">Data Guru berkala</h1>
            <p><a href="#" class="btn btn-primary px-4 py-3 mt-3">Dinas Pendidikan Kabupaten Tapin</a></p>
          </div>
        </div>
        </div>
      </div>
    </section>

		<section class="ftco-section">
			<div class="container">
				<div class="row d-flex">
					<div class="col-md-5 order-md-last wrap-about align-items-stretch">
						<div class="wrap-about-border ftco-animate">
							<div class="img" style="background-image: url(depan/images/about.jpg); border"></div>
							<div class="text-center">
								<h3>Dinas Pendidikan Kabupaten Tapin</h3>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
								<p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word.</p>
								<p><a href="#" class="btn btn-primary py-3 px-4">Contact us</a></p>
							</div>
						</div>
					</div>
					<div class="col-md-7 wrap-about pr-md-4 ftco-animate">
          	<h2 class="mb-4">Tentang Aplikasi</h2>
            <p>aplikasi untuk memudahkan guru dan pegawai dinas pendidikan Kabupaten Tapin dimana nantinya aplikasi ini dapat dikelola langsung oleh admin sekolah dan pihak Dinas Pendidikan Kabupaten Tapin</p>
						<div class="row mt-5">
							<div class="col-lg-6">
								<div class="services active text-center">
									<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-collaboration"></span></div>
									<div class="text media-body">
										<h3> Pengelolaan</h3>
										<p>Memudahkan Dinas Pendidikan Kabupaten Tapin dalam mengelola dan data guru dan data berkala guru.</p>
									</div>
								</div>
								<div class="services text-center">
									<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-analysis"></span></div>
									<div class="text media-body">
										<h3> Pelaporan</h3>
										<p>Memudahkan para guru dalam melaporkan berkas berkala mereka pada Dinas Pendidikan Kabupaten Tapin.</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="services text-center">
									<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-search-engine"></span></div>
									<div class="text media-body">
										<h3>Analisis</h3>
										<p>Memudahkan pihak Dinas Pendidikan Kabupaten dalam menganalisis data guru dan data berkala guru berdasarkan parameter-parameter tertentu.  </p>
									</div>
								</div>
								<div class="services text-center">
									<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-handshake"></span></div>
									<div class="text media-body">
										<h3>Informasi</h3>
										<p>Penyalur Informasi dari Dians Pendidikan kepada guru melalui fitur berita</p>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="ftco-section bg-light">
			<div class="container">
				<div class="row justify-content-center mb-5 pb-2">
          <div class="col-md-8 text-center heading-section ftco-animate">
            <h2 class="mb-4">Berita</h2>
          </div>
        </div>
				<div class="row">
        @if($berita != null )
            @foreach($berita as $b)
              <div class="col-md-6 col-lg-4 ftco-animate">
                <div class="blog-entry">
                  <!-- <a href="blog-single.html" class="block-20 d-flex align-items-end" style="background-image: url('/img/berita/'.$b->foto';"> -->
                  <a href="#"><img width="342" class="block-20 d-flex align-items-end" src="{{asset('/img/berita/'.$b->foto)}}" alt=""></a>
                  </a>
                  <div class="text bg-white p-4">
                    <h3 class="heading"><a href="#">{{$b->judul}}</a></h3>
                    <p>{{$b->created_at}}</p>
                    <div class="d-flex align-items-center mt-4">
                      <p class="mb-0"><a href="{{Route('beritaDetail',['id'=> $b->id ])}}" class="btn btn-primary">Read More <span class="ion-ios-arrow-round-forward"></span></a></p>
                      <p class="ml-auto mb-0">
                        <a href="#" class="mr-2">{{$b->user->name}}</a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          @endif
        </div>
        <div class="text-center">
            <a href="{{route('beritaAll')}}" class="btn btn-primary">Lebih banyak Berita >></a>
        </div>
			</div>
		</section>
		
    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-6 col-lg-6">
            <div class="ftco-footer-widget mb-5">
            	<h2 class="ftco-heading-2">Mempunyai Pertanyaan ?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-6">
            <div class="ftco-footer-widget mb-5">
            	<h2 class="ftco-heading-2 mb-0">Connect With Us</h2>
            	<ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
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