@extends('layouts.main')

@section('front-end')
<link rel="stylesheet" href="{{ asset('plugins/css-components-main/cards/card-8/style.css') }}">

<x-front-navbar></x-front-navbar>

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/train2.jpg'); width: 100%">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
			<div class="col-md-9 ftco-animate pb-5 text-center">
				<p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span> <span>About us <i class="fa fa-chevron-right"></i></span></p>
				<h1 class="mb-0 bread">About Us</h1>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section ftco-about ftco-no-pt img">
	<div class="container">
		<div class="row d-flex">
			<div class="col-md-12 about-intro">
				<div class="row">
					<div class="col-md-6 d-flex align-items-stretch">
						<div class="img d-flex w-100 align-items-center justify-content-center" style="background-image:url(images/about-1.jpg);">
						</div>
					</div>
					<div class="col-md-6 pl-md-5 py-5">
						<div class="row justify-content-start pb-3">
							<div class="col-md-12 heading-section ftco-animate">
								<span class="subheading">About Us</span>
								<h2 class="mb-4">SONIC</h2>
								<p>Terinspirasi dari Sonic the Hedgehog. Sonic terkenal karena kecepatannya yang luar biasa, yang mengajarkan nilai-nilai penting seperti ketangkasan, kemampuan untuk merespons dengan cepat terhadap tantangan, dan semangat yang tak kenal lelah. Ketangkasan Sonic menggambarkan pentingnya menjadi lincah dan siap menghadapi perubahan, sementara respons cepatnya menunjukkan bagaimana kesiapan dan kecepatan dalam bertindak dapat membantu mengatasi rintangan dengan efisien. Semangat yang tak kenal lelah yang dimiliki Sonic menginspirasi kita untuk terus maju dan tidak pernah menyerah, meskipun dihadapkan pada kesulitan atau tantangan besar. Sonic adalah simbol dari dedikasi dan kegigihan, mengingatkan kita bahwa dengan tekad dan semangat yang kuat, kita dapat mencapai tujuan kita.

								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section testimony-section bg-bottom">
	<div class="overlay"></div>
	<div class="container">
		<div class="row justify-content-center pb-4">
			<div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
				<span class="subheading">Team</span>
				<h2 class="mb-4">Our Team</h2>
			</div>
		</div>
		{{-- <div class="row ftco-animate"> --}}

			{{-- <style>
				* {
					font-family: Nunito, sans-serif;
				  }
				  
				  .text-blk {
					margin-top: 0px;
					margin-right: 0px;
					margin-bottom: 0px;
					margin-left: 0px;
					line-height: 25px;
				  }
				  
				  .responsive-cell-block {
					min-height: 75px;
				  }
				  
				  .responsive-container-block {
					min-height: 75px;
					height: fit-content;
					width: 100%;
					display: flex;
					flex-wrap: nowrap;
					margin-top: 0px;
					margin-right: auto;
					margin-bottom: 0px;
					margin-left: auto;
					justify-content: center;
					overflow-x: auto;
				  }
				  
				  .outer-container {
					padding-top: 10px;
					padding-right: 50px;
					padding-bottom: 10px;
					padding-left: 50px;
					background-color: rgb(244, 252, 255);
				  }
				  
				  .inner-container {
					max-width: 1320px;
					flex-direction: column;
					align-items: center;
					margin-top: 50px;
					margin-right: auto;
					margin-bottom: 50px;
					margin-left: auto;
				  }
				  
				  .section-head-text {
					margin-top: 0px;
					margin-right: 0px;
					margin-bottom: 5px;
					margin-left: 0px;
					font-size: 35px;
					font-weight: 700;
					line-height: 48px;
					color: rgb(0, 135, 177);
					margin: 0 0 10px 0;
				  }
				  
				  .section-subhead-text {
					font-size: 25px;
					color: rgb(153, 153, 153);
					line-height: 35px;
					max-width: 470px;
					text-align: center;
					margin-top: 0px;
					margin-right: 0px;
					margin-bottom: 60px;
					margin-left: 0px;
				  }
				  
				  .img-wrapper {
					width: 100%;
				  }
				  
				  .team-card {
					display: flex;
					flex-direction: column;
					align-items: center;
				  }
				  
				  .social-media-links {
					width: 125px;
					display: flex;
					justify-content: space-between;
				  }
				  
				  .name {
					font-size: 25px;
					font-weight: 700;
					color: rgb(102, 102, 102);
					margin-top: 0px;
					margin-right: 0px;
					margin-bottom: 5px;
					margin-left: 0px;
				  }
				  
				  .position {
					font-size: 25px;
					font-weight: 700;
					color: rgb(0, 135, 177);
					margin-top: 0px;
					margin-right: 0px;
					margin-bottom: 50px;
					margin-left: 0px;
				  }
				  
				  .team-img {
					width: 100%;
					height: 100%;
					filter: grayscale(70%);
					transition: filter 0.3s, transform 0.3s;
				  }
				  
				  .team-img:hover {
					filter: grayscale(0%);
					transform: scale(1.1);
				  }
				  
				  .team-card-container {
					width: 18%;
					margin: 0 1%;
					box-sizing: border-box;
				  }
				  
				  @media (max-width: 500px) {
					.outer-container {
					  padding: 10px 20px 10px 20px;
					}
				  
					.section-head-text {
					  text-align: center;
					}
					.team-card-container {
					  width: 100%;
					}
					.responsive-container-block {
					  flex-wrap: wrap;
					}
				  }
				  
				  html, body {
					overflow-x: hidden;
				  }
			</style> --}}
				

			<div class="responsive-container-block outer-container">
				<div class="responsive-container-block inner-container">
					<div class="responsive-container-block">
						<div class="responsive-cell-block wk-desk-3 wk-ipadp-3 wk-tab-6 wk-mobile-12 team-card-container">
							<div class="team-card">
								<div class="img-wrapper">
									<img class="team-img" src="{{ asset('images/bane2.jpg') }}">
								</div>
								<p class="text-blk name">
									Brisbane Sihombing
								</p>
								<p class="text-blk position">
									Back End Developer
								</p>
							</div>
						</div>
						<div class="responsive-cell-block wk-desk-3 wk-ipadp-3 wk-tab-6 wk-mobile-12 team-card-container">
							<div class="team-card">
								<div class="img-wrapper">
									<img class="team-img" src="{{ asset('images/mayadi.jpg') }}">
								</div>
								<p class="text-blk name">
									Mayadi Silalahi
								</p>
								<p class="text-blk position">
									Back End Developer
								</p>
							</div>
						</div>
						<div class="responsive-cell-block wk-desk-3 wk-ipadp-3 wk-tab-6 wk-mobile-12 team-card-container">
							<div class="team-card">
								<div class="img-wrapper">
									<img class="team-img" src="{{ asset('images/paskal.jpg') }}">
								</div>
								<p class="text-blk name">
									Paskal Manik
								</p>
								<p class="text-blk position">
									Back End Developer
								</p>
							</div>
						</div>
						<div class="responsive-cell-block wk-desk-3 wk-ipadp-3 wk-tab-6 wk-mobile-12 team-card-container">
							<div class="team-card">
								<div class="img-wrapper">
									<img class="team-img" src="{{ asset('images/petra.jpg') }}">
								</div>
								<p class="text-blk name">
									Petra Keliat
								</p>
								<p class="text-blk position">
									Front End Developer
								</p>
							</div>
						</div>
						<div class="responsive-cell-block wk-desk-3 wk-ipadp-3 wk-tab-6 wk-mobile-12 team-card-container">
							<div class="team-card">
								<div class="img-wrapper">
									<img class="team-img" src="{{ asset('images/blckjak.jpg') }}">
								</div>
								<p class="text-blk name">
									Syuja Aqilsyah
								</p>
								<p class="text-blk position">
									Front End Developer
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		
		{{-- </div> --}}
	</div>
</section>

<footer class="ftco-footer bg-bottom ftco-no-pt" style="background-image: url(images/bg_3.jpg);">
	<div class="container">
		<div class="row mb-5">
			<div class="col-md pt-5">
				<div class="ftco-footer-widget pt-md-5 mb-4">
					<h2 class="ftco-heading-2">About</h2>
					<p>Sonic yang berarti kecepatan. Ini menandakan website
						kami memberi respon dengan cepat dan bisa diandalkan. Sesuai dengan kebutuhan pengguna kami.</p>
					<ul class="ftco-footer-social list-unstyled float-md-left float-lft">
						<li class="ftco-animate"><a href="https://www.instagram.com/sonicjourneyy?igsh=ZmxzMzM1c201ancx&utm_source=qr" target="_blank"><span class="fa fa-twitter"></span></a></li>
						<li class="ftco-animate"><a href="" target="_blank"><span class="fa fa-facebook"></span></a></li>
						<li class="ftco-animate"><a href="https://www.instagram.com/sonicjourneyy?igsh=ZmxzMzM1c201ancx&utm_source=qr" target="_blank"><span class="fa fa-instagram"></span></a></li>
					</ul>
				</div>
			</div>
			<div class="col-md pt-5 border-left">
				<div class="ftco-footer-widget pt-md-5 mb-4">
					<h2 class="ftco-heading-2">Have a Questions?</h2>
					<div class="block-23 mb-3">
						<ul>
							<li><span class="icon fa fa-map-marker"></span><span class="text">Gedung C Fasilkom-TI, Universitas Sumatera Utara, Jl. Alumni No.3, Padang Bulan, Kec. Medan Baru, Kota Medan, Sumatera Utara 20155</span></li>
							<li><a href="https://wa.me/6281260679408?text=Ingin%20Melaporkan%20Masalah"><span class="icon fa fa-whatsapp"></span><span class="text">081260679408 Admin 1(Petra)
										</span></a></li>
							<li><a href="https://wa.me/6281364981832?text=Ingin%20Melaporkan%20Masalah"><span class="icon fa fa-whatsapp"></span><span class="text">081364981832 Admin 2(syuja)
										</span></a></li>
							<li><a href="#"><span class="icon fa fa-paper-plane"></span><span class="text">Sonic@gmail.com</span></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-center">

				<p>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					Sonic &copy;
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