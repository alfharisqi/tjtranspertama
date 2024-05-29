@extends('layouts.front')

@section('front')
<div class="wrapper">
    <!-- Navbar -->
    <x-front-dashboard-navbar></x-front-dashboard-navbar>
    <!-- /.Navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/dashboard" class="brand-link">
            <img src="{{ asset('favicon.ico') }}" alt="Sonic Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Sonic</span>
        </a>

        <!-- Sidebar Menu -->
        <x-front-sidemenu></x-front-sidemenu>
        <!-- /.sidebar Menu -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Pesanan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Pesanan</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if (session('ticketNotFound1'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('ticketNotFound1') }}
                        </div>
                        @endif

                        @if (session('ticketNotFound2'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('ticketNotFound2') }}
                        </div>
                        @endif
                        <!-- Pesanan elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Form Pesanan</h3>
                            </div>
                            <!-- /.card-header --> <!-- MULAI FORM -->
                            <form action="/orders" method="POST">
                                @csrf
                                @method('POST')
                                <div class="card-body">
                                    <h4>Data Tiket</h4>

                                    <div class="form-group row">
                                        <label for="ticket_id" class="col-sm-2 col-form-label">Pilih Tiket</label>
                                        <select name="ticket_id" id="ticket_id" class="form-control col-sm-10" required>
                                            <option selected value="" disabled>Pilih Tiket</option>
                                            @foreach ($tickets as $ticket)
                                            <option value="{{ $ticket->id }}" {{ old('ticket_id') == $ticket->id ? 'selected' : '' }}>
                                                {{ $ticket->track->from_route }} - {{ $ticket->track->to_route }} | {{ $ticket->train->class }} | {{ $ticket->departure_time }} s.d {{ $ticket->arrival_time }} | Biaya: Rp {{ $ticket->price->price }}.
                                            </option>
                                            @endforeach
                                        </select>

                                    </div>


                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah :</label>
                                        <div class="col-sm-2">
                                            <select class="form-control" id="jumlah-penumpang" name="amount">
                                                @for ($i = 1; $i <= 5; $i++) @if ($i==old('amount')) <option value={{ $i }} selected>{{ $i }}
                                                    </option>
                                                    @else
                                                    <option value={{ $i }}>{{ $i }}</option>
                                                    @endif
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Pergi :</label>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <input type="date" class="form-control" id="tanggalpergi" min="<?php echo date('Y-m-d'); ?>" placeholder="hh/bb/tttt" name="go_date" required value="{{ old('go_date') }}">
                                            </div>
                                        </div>
                                    </div>

                                    @if ($errors->has('go_date'))
                                    <div class="invalid-feedback">
                                        Pilih tanggal pergi dengan benar!
                                    </div>
                                    @endif


                                    <div class="form-group row" id="penumpang-1">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Penumpang 1:</label>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control @error('nama_penumpang_1') is-invalid @enderror" id="inputEmail3" placeholder="Nama" name="nama_penumpang_1" required value="{{ old('nama_penumpang_1') }}">
                                                @error('nama_penumpang_1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <label for="inputEmail3" class="col-sm-1 col-form-label">KTP :</label>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="KTP" name="nik_penumpang_1" required value="{{ old('nik_penumpang_1') }}">
                                            </div>
                                        </div>
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis
                                            Kelamin:</label>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <select class="form-control" name="jenis_penumpang_1" required>
                                                    <option disabled selected>-- Kelamin --</option>

                                                    <option value="true" @if (old('jenis_penumpang_1')=='true' ) selected @else @endif>
                                                        Laki-Laki</option>
                                                    <option value="false" @if (old('jenis_penumpang_1')=='false' ) selected @else @endif>
                                                        Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="penumpang-2">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Penumpang 2:</label>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Nama" name="nama_penumpang_2" value="{{ old('nama_penumpang_2') }}">
                                            </div>
                                        </div>
                                        <label for="inputEmail3" class="col-sm-1 col-form-label">KTP :</label>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="KTP" name="nik_penumpang_2" value="{{ old('nik_penumpang_2') }}">
                                            </div>
                                        </div>
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis
                                            Kelamin:</label>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <select class="form-control" name="jenis_penumpang_2">
                                                    <option disabled selected>-- Kelamin --</option>

                                                    <option value="true" @if (old('jenis_penumpang_2')=='true' ) selected @else @endif>
                                                        Laki-Laki</option>
                                                    <option value="false" @if (old('jenis_penumpang_2')=='false' ) selected @else @endif>
                                                        Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="penumpang-3">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Penumpang 3:</label>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Nama" name="nama_penumpang_3" value="{{ old('nama_penumpang_3') }}">
                                            </div>
                                        </div>
                                        <label for="inputEmail3" class="col-sm-1 col-form-label">KTP :</label>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="KTP" name="nik_penumpang_3" value="{{ old('nik_penumpang_3') }}">
                                            </div>
                                        </div>
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis
                                            Kelamin:</label>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <select class="form-control" name="jenis_penumpang_3">
                                                    <option disabled selected>-- Kelamin --</option>

                                                    <option value="true" @if (old('jenis_penumpang_3')=='true' ) selected @else @endif>
                                                        Laki-Laki</option>
                                                    <option value="false" @if (old('jenis_penumpang_3')=='false' ) selected @else @endif>
                                                        Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="penumpang-4">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Penumpang 4:</label>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Nama" name="nama_penumpang_4" value="{{ old('nama_penumpang_4') }}">
                                            </div>
                                        </div>
                                        <label for="inputEmail3" class="col-sm-1 col-form-label">KTP :</label>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="KTP" name="nik_penumpang_4" value="{{ old('nik_penumpang_4') }}">
                                            </div>
                                        </div>
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis
                                            Kelamin:</label>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <select class="form-control" name="jenis_penumpang_4">
                                                    <option disabled selected>-- Kelamin --</option>

                                                    <option value="true" @if (old('jenis_penumpang_4')=='true' ) selected @else @endif>
                                                        Laki-Laki</option>
                                                    <option value="false" @if (old('jenis_penumpang_4')=='false' ) selected @else @endif>
                                                        Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="penumpang-5">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Penumpang 5:</label>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Nama" name="nama_penumpang_5" value="{{ old('nama_penumpang_5') }}">
                                            </div>
                                        </div>
                                        <label for="inputEmail3" class="col-sm-1 col-form-label">KTP :</label>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="KTP" name="nik_penumpang_5" value="{{ old('nik_penumpang_5') }}">
                                            </div>
                                        </div>
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis
                                            Kelamin:</label>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <select class="form-control" name="jenis_penumpang_5">
                                                    <option disabled selected>-- Kelamin --</option>

                                                    <option value="true" @if (old('jenis_penumpang_5')=='true' ) selected @else @endif>
                                                        Laki-Laki</option>
                                                    <option value="false" @if (old('jenis_penumpang_5')=='false' ) selected @else @endif>
                                                        Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <h4>Data Pembayaran</h4>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Metode
                                            Pembayaran:</label>
                                        <div class="col-lg-2 col-sm-12">
                                            <div class="form-group">
                                                <select class="form-control" id="method_id" name="method_id">
                                                    @if (old('method_id'))
                                                    <option value={{ old('method_id') }}>
                                                        {{ $methods->where('id', old('method_id'))->first()->method }}
                                                    </option>
                                                    @else
                                                    <option disabled selected>-- Metode Pembayaran --</option>
                                                    @endif
                                                    @foreach ($methods as $method)
                                                    @if ($method->id != old('method_id'))
                                                    <option value="{{ $method->id }}">{{ $method->method }}
                                                    </option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <label for="inputEmail3" class="col-sm-1 col-form-label">Atas Nama:</label>
                                        <div class="col-lg-3 col-sm-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name_account" id="name_account" placeholder="Nama Lengkap" required value="{{ old('name_account') }}">
                                                <small class="text-muted">Nama lengkap pada rekening</small>
                                            </div>
                                        </div>

                                        <label for="inputEmail3" class="col-sm-1 col-form-label">Nomor:</label>
                                        <div class="col-lg-3 col-sm-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="from_account" id="name_account" placeholder="Nomor Lengkap" required value="{{ old('from_account') }}">
                                                <small class="text-muted">Nomor lengkap pada rekening</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>

                            <!-- /.card-body -->
                        </div>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Sonic &copy; 2024.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@endsection