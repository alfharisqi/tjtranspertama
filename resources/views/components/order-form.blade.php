<form action="{{ route('orders.store') }}" method="POST">
    @csrf

        {{-- Main Section --}}
    <section class="ftco-section">
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

                                
                                {{-- Data Alamat --}}
                                <hr>
                                <h6 class="mb-3">Alamat Pemesanan</h6>
                                <div class="form-row mb-2">
                                    <div class="col-md-6">
                                        <label>Alamat Lengkap</label>
                                        <textarea class="form-control" name="alamat_lengkap" rows="2" required>{{ old('alamat_lengkap') }}</textarea>
                                        <small class="text-muted">Contoh: Jl. Merdeka No.123, RT 4/RW 5, Kel. Sukamaju</small>
                                        <small class="text-muted">dan Tambahkan share link google maps untuk lebih detail</small>
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
                                                <input type="text" name="nama_penumpang_{{ $i }}" class="form-control" value="{{ old('nama_penumpang_'.$i) }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="nik_penumpang_{{ $i }}" class="form-label">NIK</label>
                                                <input type="text" name="nik_penumpang_{{ $i }}" class="form-control" value="{{ old('nik_penumpang_'.$i) }}">
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
                                
                                {{-- Pilih Kursi --}}
                                <hr>
                                <h6 class="mb-3">Pilih Kursi</h6>
                                <p class="text-muted mb-2">Klik untuk memilih kursi untuk setiap penumpang.</p>
                                <style>
                                    .seat {
                                        width: 40px;
                                        height: 40px;
                                        margin: 5px;
                                        text-align: center;
                                        vertical-align: middle;
                                        line-height: 40px;
                                        border-radius: 5px;
                                        cursor: pointer;
                                        background-color: #e0e0e0;
                                        border: 1px solid #ccc;
                                    }
                                    .seat.selected {
                                        background-color: #28a745;
                                        color: white;
                                    }
                                    .seat.occupied {
                                        background-color: #dc3545;
                                        cursor: not-allowed;
                                    }
                                </style>

                                <div id="seat-map" class="mb-3">
                                    @php
                                        $rows = [
                                            ['01', '', '02'],
                                            ['03', '', '04'],
                                            ['05', '', '06'],
                                            ['07', '', '08'],
                                            ['09', '10','11'],
                                        ];
                                        $occupiedSeats = []; // bisa diisi dari backend nanti
                                    @endphp

                                    @foreach ($rows as $row)
                                        <div class="d-flex">
                                            @foreach ($row as $seat)
                                                @if ($seat === '')
                                                    <div style="width: 40px; height: 40px; margin: 5px;"></div>
                                                @else
                                                    <div class="seat {{ in_array($seat, $occupiedSeats) ? 'occupied' : '' }}" data-seat="{{ $seat }}">
                                                        {{ $seat }}
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group">
                                    <label for="selected_seats">Kursi yang dipilih</label>
                                    <input type="text" name="selected_seats" id="selected_seats" class="form-control" readonly required value="{{ old('selected_seats') }}">
                                    <small class="text-muted">Jumlah kursi yang dipilih harus sesuai jumlah penumpang.</small>
                                </div>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        const seats = document.querySelectorAll('.seat:not(.occupied)');
                                        const input = document.getElementById('selected_seats');
                                        const jumlah = document.getElementById('jumlah-penumpang');

                                        let selectedSeats = [];

                                        seats.forEach(seat => {
                                            seat.addEventListener('click', () => {
                                                const seatNumber = seat.dataset.seat;
                                                const max = parseInt(jumlah.value);

                                                if (seat.classList.contains('selected')) {
                                                    seat.classList.remove('selected');
                                                    selectedSeats = selectedSeats.filter(s => s !== seatNumber);
                                                } else {
                                                    if (selectedSeats.length < max) {
                                                        seat.classList.add('selected');
                                                        selectedSeats.push(seatNumber);
                                                    } else {
                                                        alert('Jumlah kursi tidak boleh lebih dari jumlah penumpang');
                                                    }
                                                }

                                                input.value = selectedSeats.join(',');
                                            });
                                        });

                                        jumlah.addEventListener('change', () => {
                                            selectedSeats = [];
                                            seats.forEach(seat => seat.classList.remove('selected'));
                                            input.value = '';
                                        });
                                    });
                                </script>


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

                                

                                {{-- Submit --}}
                                <hr>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary px-4">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div> {{-- card --}}
                </div>
            </div>
        </div>

        {{-- Dynamic Passenger JS --}}
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
</form>
