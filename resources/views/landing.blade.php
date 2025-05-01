@extends('layouts.main')

@section('front-end')
<x-front-navbar></x-front-navbar>

<div class="hero-wrap js-fullheight" style="background-image: url('images/travellandingpage.png');">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
			<div class="col-md-7 ftco-animate">
				<h1 class="mb-4">Selamat Datang di</h1>
				<h1 class="mb-4">TJ Trans</h1>
				<p class="caps">Aplikasi berbasis website untuk jasa pemesanan travel</p>
				<a href="/pesantiket" class="btn btn-primary">Pesan Sekarang!</a>
			</div>
		</div>
	</div>
</div>



<footer class="ftco-footer bg-bottom ftco-no-pt" style="background-image: url(images/bg_3.jpg);">
	<div class="container">
		<div class="row mb-5">
			<div class="col-md pt-5">
				<div class="ftco-footer-widget pt-md-5 mb-4">
					<h2 class="ftco-heading-2">About</h2>
					<p>Kami di TJ Trans berkomitmen untuk memberikan layanan transportasi yang aman, nyaman, dan tepat waktu. Dengan pengalaman bertahun-tahun, kami melayani berbagai kebutuhan perjalanan Anda, mulai dari perjalanan pribadi hingga layanan transportasi korporat. Percayakan perjalanan Anda pada kami, dan nikmati kenyamanan serta kualitas layanan terbaik.</p>
					<ul class="ftco-footer-social list-unstyled float-md-left float-lft">
						<li class="ftco-animate"><a href="" target="#"><span class="fa fa-twitter"></span></a></li>
						<li class="ftco-animate"><a href="" target="#"><span class="fa fa-facebook"></span></a></li>
						<li class="ftco-animate"><a href="" target="#"><span class="fa fa-instagram"></span></a></li>
					</ul>
				</div>
			</div>
			<div class="col-md pt-5 border-left">
				<div class="ftco-footer-widget pt-md-5 mb-4">
					<h2 class="ftco-heading-2">Have a Questions?</h2>
					<div class="block-23 mb-3">
						<ul>
							<li><span class="icon fa fa-map-marker"></span><span class="text">Alamat</span></li>
							<li><a href=""><span class="icon fa fa-whatsapp"></span><span class="text">123 Admin 1
										</span></a></li>
							<li><a href=""><span class="icon fa fa-whatsapp"></span><span class="text">123 Admin 2
										</span></a></li>
							<li><a href="#"><span class="icon fa fa-paper-plane"></span><span class="text">tjtrans@gmail.com</span></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-center">

				<p>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					TJ Trans &copy;
					<script>
						document.write(new Date().getFullYear());
					</script>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				</p>
			</div>
		</div>
	</div>
</footer>



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
		<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
		<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
	</svg></div>
@endsection