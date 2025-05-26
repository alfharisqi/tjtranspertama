@extends('layouts.main')

@section('front-end')
<x-front-navbar></x-front-navbar>



<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/travellandingpage.png');">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
			<div class="col-md-9 ftco-animate pb-5 text-center">
				<p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span> <span>Pesan Ticket <i class="fa fa-chevron-right"></i></span></p>
				<h1 class="mb-0 bread">Pesan Ticket</h1>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section" >

<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <div class="col-md-10">

            {{-- Alert Messages --}}
            @if (session('success'))
                <div class="alert alert-success py-2 px-3 mb-2">{{ session('success') }}</div>
            @endif

            @if (session('ticketNotFound1'))
                <div class="alert alert-danger py-2 px-3 mb-2" role="alert">{{ session('ticketNotFound1') }}</div>
            @endif

            @if (session('ticketNotFound2'))
                <div class="alert alert-danger py-2 px-3 mb-2" role="alert">{{ session('ticketNotFound2') }}</div>
            @endif

            {{-- Form Card --}}
            <div class="card">
                <div class="card-header bg-warning text-white py-2">
                    <h5 class="mb-0">Form Pesanan</h5>
                </div>

                <form action="/pesantiket" method="POST">
                    @csrf

                    <div class="card-body">

                        {{-- Data Tiket --}}
                        <h6 class="mb-3">Data Tiket</h6>

                        <div class="form-group mb-2">
                            <label for="ticket_id">Pilih Tiket</label>
                            <select name="ticket_id" id="ticket_id" class="form-control" required>
                                <option selected disabled value="">Pilih Tiket</option>
                                @foreach ($tickets as $ticket)
                                    <option value="{{ $ticket->id }}" {{ old('ticket_id') == $ticket->id ? 'selected' : '' }}>
                                        {{ $ticket->track->from_route }} - {{ $ticket->track->to_route }} | {{ $ticket->train->class }} |
                                        {{ $ticket->departure_time }} s.d {{ $ticket->arrival_time }}
                                        @if($ticket->price)
                                            | Biaya: Rp {{ $ticket->price->price }}
                                        @else
                                            | Biaya: Tidak tersedia
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-row mb-2">
                            <div class="col-md-3">
                                <label>Jumlah</label>
                                <select class="form-control" name="amount" id="jumlah-penumpang" required>
                                    @for ($i = 1; $i <= 11; $i++)
                                        <option value="{{ $i }}" {{ old('amount') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>Pergi</label>
                                <input type="date" class="form-control" name="go_date" min="{{ date('Y-m-d') }}" required value="{{ old('go_date') }}">
                            </div>
                        </div>
                        
                        {{-- Data Penumpang --}}
                        <hr>
                        <h6 class="mb-3">Data Penumpang</h6>

                        @for ($i = 1; $i <= 5; $i++)
<div class="card mb-3 penumpang-form penumpang-{{ $i }}" style="{{ old('amount', 1) < $i ? 'display:none;' : '' }}">
    <div class="card-body">
        <h5 class="card-title">Penumpang ke-{{ $i }}</h5>

        <div class="mb-3">
            <label for="nama_penumpang_{{ $i }}" class="form-label">Nama</label>
            <input type="text" name="nama_penumpang_{{ $i }}" class="form-control"
                value="{{ old('nama_penumpang_'.$i) }}">
        </div>

        <div class="mb-3">
            <label for="nik_penumpang_{{ $i }}" class="form-label">NIK</label>
            <input type="text" name="nik_penumpang_{{ $i }}" class="form-control"
                value="{{ old('nik_penumpang_'.$i) }}">
        </div>

        <div class="mb-3">
            <label for="jenis_penumpang_{{ $i }}" class="form-label">Jenis Kelamin</label>
            <select name="jenis_penumpang_{{ $i }}" class="form-select">
                <option value="true" {{ old('jenis_penumpang_'.$i) == "true" ? 'selected' : '' }}>Laki-laki</option>
                <option value="false" {{ old('jenis_penumpang_'.$i) == "false" ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
    </div>
</div>
@endfor

{{-- Lanjutkan ke dalam form --}}

{{-- Data Pembayaran --}}
<hr>
<h6 class="mb-3">Data Pembayaran</h6>

<div class="form-row mb-2">
    <div class="col-md-3">
        <label>Metode Pembayaran</label>
        <select class="form-control" name="method_id" required>
            <option disabled selected>-- Pilih Metode --</option>
            @foreach ($methods as $method)
                <option value="{{ $method->id }}" {{ old('method_id') == $method->id ? 'selected' : '' }}>{{ $method->method }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label>Atas Nama</label>
        <input type="text" class="form-control" name="name_account" placeholder="Nama Lengkap" required value="{{ old('name_account') }}">
        <small class="text-muted">Nama sesuai rekening</small>
    </div>
    <div class="col-md-3">
        <label>Nomor Rekening</label>
        <input type="text" class="form-control" name="from_account" placeholder="No. Rekening" required value="{{ old('from_account') }}">
        <small class="text-muted">Nomor rekening pengirim</small>
    </div>
</div>

{{-- Data Alamat --}}
<hr>
<h6 class="mb-3">Alamat Pemesanan</h6>

<div class="form-row mb-2">
    <div class="col-md-6">
        <label>Alamat Lengkap</label>
        <textarea class="form-control" name="alamat_lengkap" rows="2" required>{{ old('alamat_lengkap') }}</textarea>
        <small class="text-muted">Contoh: Jl. Merdeka No.123, RT 4/RW 5, Kel. Sukamaju</small>
    </div>
</div>

{{-- Submit --}}
<hr>
<div class="form-group text-right">
    <button type="submit" class="btn btn-primary px-4">Submit</button>
</div>

</div> {{-- card-body --}}
</form>
</div> {{-- card --}}


        </div>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function () {
    const jumlahPenumpang = document.getElementById('jumlah-penumpang');
    const penumpangForms = document.querySelectorAll('.penumpang-form');

    function updatePenumpangFields() {
        const jumlah = parseInt(jumlahPenumpang.value);
        penumpangForms.forEach((form, index) => {
            form.style.display = index < jumlah ? 'flex' : 'none';
        });
    }

    jumlahPenumpang.addEventListener('change', updatePenumpangFields);
    updatePenumpangFields();
});
</script>

</section>


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