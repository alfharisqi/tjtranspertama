@extends('layouts.front')

@section('front')
<div class="wrapper">
    <!-- Navbar -->
    <x-front-dashboard-navbar></x-front-dashboard-navbar>
    <!-- /.Navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/dashboard" class="brand-link">
            <img src="{{ asset('favicon.ico') }}" alt="tjtrans Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">TJ Trans Executive</span>
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
                        <h1>Harga</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Harga</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif
                                @if (session('sameTicket'))
                                <div class="alert alert-danger">
                                    {{ session('sameTicket') }}
                                </div>
                                @endif
                                @if (session('delete'))
                                <div class="alert alert-success">
                                    {{ session('delete') }}
                                </div>
                                @endif
                                @if (session('update'))
                                <div class="alert alert-success">
                                    {{ session('update') }}
                                </div>
                                @endif

                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <h3 class="card-title">Data Harga Tiket</h3>
                                    </div>
                                    @can('isAdmin')
                                    <div class="col-sm-6">
                                        <button class="btn btn-warning btn-sm float-sm-right" type="button" data-toggle="modal" data-target="#modal-lgharga" id="button-tambah-harga">Tambah Tiket
                                        </button>

                                        <div class="modal fade" id="modal-lgharga">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Form Tambah Tiket</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <form action="/tickets" method="POST">
                                                        @csrf
                                                        @method('POST')

                                                        <div class="modal-body">
                                                            <div class="form-group row">
                                                                <label for="train_id" class="col-sm-2 col-form-label">Bus dan Kelas</label>
                                                                <select name="train_id" id="train_id" class="form-control col-sm-10" required>
                                                                    <option selected value="" disabled>Pilih
                                                                    Bus dan Kelas
                                                                    </option>
                                                                    @foreach ($trains as $train)
                                                                    @if (old('train_id') == $train->id)
                                                                    <option value="{{ $train->id }}" selected>
                                                                        {{ $train->name }} - {{ $train->class }}
                                                                    </option>
                                                                    @else
                                                                    <option value="{{ $train->id }}">
                                                                        {{ $train->name }} - {{ $train->class }}
                                                                    </option>
                                                                    @endif
                                                                    @endforeach
                                                                </select>

                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="track_id" class="col-sm-2 col-form-label">Rute</label>
                                                                <select name="track_id" id="track_id" class="form-control col-sm-10" 0 onchange="getSelectValue(this.value);" required>
                                                                    <option selected value="" disabled>Pilih Rute
                                                                    </option>
                                                                    @foreach ($tracks as $track)
                                                                    <option value="{{ old('track_id', $track->id) }}">
                                                                        {{ $track->from_route }} -
                                                                        {{ $track->to_route }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="departure_time" class="col-sm-2 col-form-label">Waktu Keberangkatan</label>
                                                                <input type="time" id="departure_time" name="departure_time" required>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="inputName2" class="col-sm-2 col-form-label">Harga</label>
                                                                <input type="number" class="form-control col-sm-10" placeholder="Harga Baru" name='price' id='hargaadd' min="0" required>
                                                            </div>

                                                            @if (session('sameTicket'))
                                                            <div class="alert alert-danger">
                                                                {{ session('sameTicket') }}
                                                            </div>
                                                            @endif
                                                        </div>


                                                        <div class="modal-footer">

                                                            <input type="submit" class="btn btn-success" name="submit" value="Submit" />

                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    @endcan
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Bus</th>
                                            <th>Kelas</th>

                                            <th>Pergi dari</th>
                                            <th>Tujuan ke</th>
                                            <th>Waktu Keberangkatan</th>
                                            <th>Waktu Tiba</th>

                                            <th>Jumlah Harga</th>
                                            @can('isAdmin')
                                            <th>Action</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tickets as $ticket)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                @isset($ticket->train->name)
                                                {{ $ticket->train->name }}
                                                @else
                                                Tidak dapat ditampilkan
                                                @endisset
                                            </td>
                                            <td>
                                                @isset($ticket->train->class)
                                                {{ $ticket->train->class }}
                                                @else
                                                Tidak dapat ditampilkan
                                                @endisset
                                            </td>
                                            <td>
                                                @isset($ticket->track->from_route)
                                                {{ $ticket->track->from_route }}
                                                @else
                                                Tidak dapat ditampilkan
                                                @endisset
                                            </td>
                                            <td>
                                                @isset($ticket->track->to_route)
                                                {{ $ticket->track->to_route }}
                                                @else
                                                Tidak dapat ditampilkan
                                                @endisset
                                            </td>
                                            <td>
                                                @isset($ticket->departure_time)
                                                {{ $ticket->departure_time }}
                                                @else
                                                Tidak dapat ditampilkan
                                                @endisset
                                            </td>
                                            <td>
                                                @isset($ticket->arrival_time)
                                                {{ $ticket->arrival_time }}
                                                @else
                                                Tidak dapat ditampilkan
                                                @endisset
                                            </td>
                                            <td>
                                                @isset($ticket->price->price)
                                                Rp {{ $ticket->price->price }}
                                                @else
                                                Belum di set
                                                @endisset
                                            </td>
                                            @can('isAdmin')
                                            <td>
                                                <a class='btn btn-primary btn-xs mx-1' data-toggle="modal" data-target="#modal-{{ $ticket->id }}">Ubah Harga</a>
                                                <form action="/tickets/{{ $ticket->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class='btn btn-danger btn-xs mx-1'>Delete</button>
                                                </form>
                                            </td>
                                            @endcan
                                            <div class="modal fade" id="modal-{{ $ticket->id }}">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Form Ubah Harga</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form action="/prices/{{ $ticket->price ? $ticket->price->id : '' }}" method="POST">
                                                                @method('PUT')
                                                                @csrf
                                                                <div class="form-group row">
                                                                    <label for="inputName2" class="col-sm-2 col-form-label">Harga Lama</label>
                                                                    <label for="inputName2" class="col-sm-2 col-form-label">
                                                                        @if ($ticket->price)
                                                                        {{ $ticket->price->price }}
                                                                        @else
                                                                        Not Set Yet
                                                                        @endif
                                                                    </label>
                                                                </div>


                                                                <div class="form-group row">
                                                                    <label for="inputName2" class="col-sm-2 col-form-label">Harga
                                                                        Baru</label>
                                                                    <input type="number" class="col-sm-3 form-control col-sm-10" placeholder="Harga Baru" name='price' id='hargaadd' required>
                                                                </div>

                                                                <input type="submit" class="btn btn-success" />

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                        @endforeach
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>TJ Trans Executive &copy; 2025.</strong>
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
@endsection