@include('frontend.templates.header')
@include('frontend.templates.navbar')
@section('title', 'Detail Produk | {{ $data["transaksi"]["id"] }}')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<style>
    .countdown {
      font-weight: bold;
      color: red;
    }
    .info-box {
      background-color: #fff3cd;
      padding: 15px;
      border-radius: 10px;
      margin-bottom: 15px;
    }
    .card-title small {
      font-size: 14px;
    }
    .badge-topup {
      background-color: #198754;
      color: #fff;
    }
    .product-card {
      border-radius: 1rem;
      border: 1px solid #eee;
      padding: 1.5rem;
      background-color: #fff;
      max-width: 100%;
      margin: auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    .top-up-badge {
      background-color: #28a745;
      color: #fff;
      font-size: 0.75rem;
      padding: 2px 8px;
      border-radius: 0.5rem;
      font-weight: bold;
      margin-right: 0.5rem;
    }

    .product-img {
      width: 64px;
      height: 64px;
      object-fit: cover;
      border-radius: 0.5rem;
    }

    .label {
      color: #6c757d;
      min-width: 80px;
    }

    .value {
      font-weight: 500;
    }
  </style>

<div class="container my-4">
    <div class="row g-4 mt-5">
      <!-- Card utama -->
      <div class="col-md-8 mt-5">
        <div class="product-card shadow-sm mt-5" >
          <div class="card-body">
            {{-- <div class="info-box mb-3">
              <div class="d-flex justify-content-between align-items-center">
                <div><strong>Bayar transaksi kamu, yuk!</strong></div>
                <div class="countdown">00:29:35</div>
              </div>
              <small>Batas waktu bayar</small>
            </div> --}}

            <div class="d-flex align-items-center mb-3">
              <img src="{{ asset('storage/' . $data['transaksi']['produk']['image']) }}" class="rounded me-3" style="width: 64px; height: 64px; object-fit: cover;">
              <div>
                <span class="badge badge-topup">{{ $data['produk']['categori']['name'] }}</span>
                <h5 class="mb-0">{{ $data['produk']['item'] }}</h5>
                <small class="text-muted">{{ $data['produk']['game']['name'] }}</small>
              </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
              <span><strong>Total Pembayaran</strong></span>
              <span class="fs-5 fw-bold text-dark">Rp {{ number_format($data['transaksi']['subtotal'],0,'.','.') }}</span>
            </div>

            <span class="me-2">Bayar dengan:</span>
            <div class="mb-3">
              <img src="{{ '../../Front-end/' }}assets/images/qrcode.jpg" style="height: 200px;width:200px;">
              {{-- <strong class="ms-1">DANA</strong> --}}
            </div>
            <!-- Button trigger modal -->

            <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Kirim bukti pembayaran
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kirim bukti pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('home.bukti_pembayaran') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">
                            @if (!$data['transaksi']['transaksi']['picture'])
                            <div class="mb-3">
                                <input type="hidden" name="transaction_id" value="{{ $data['transaksi']['transaksi']['id'] }}">
                                <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran</label>
                                <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                            @else
                            <img src="{{ asset('storage/' . $data['transaksi']['transaksi']['picture']) }}" class="rounded me-3" style="height: 200px;width:200px; object-fit: cover;">
                            @endif
                        </div>
                    </form>

                </div>

            </div>
        </div>
            {{-- <button class="btn btn-primary w-100">Bayar sekarang</button> --}}

            <hr>

            <div class="row mb-2">
                <div class="col-4 label">Status Pembayaran</div>
                <div class="col-8 value">
                    <span class="text bg-warning p-1 rounded text-sm">{{ $data['transaksi']['transaksi']['status_pembayaran'] }}</span>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4 label">Status</div>
                <div class="col-8 value">
                    <span class="text bg-warning p-1 rounded text-sm">{{ $data['transaksi']['status'] }}</span>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4 label">No Transaksi</div>
                <div class="col-8 value">{{ $data['transaksi']['transaksi']['transaction_code'] }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-4 label">Waktu transaksi</div>
                @php
                    use Carbon\Carbon;

                    $tanggal = Carbon::parse($data['transaksi']['transaksi']['date'])->translatedFormat('l, d F Y - h:iA ');
                @endphp

                <div class="col-8 value">{{ $tanggal }}</div>
                {{-- <div class="col-8 value">{{ $data['transaksi']['transaksi']['date'] }}</div> --}}
            </div>

          </div>
        </div>
        <div class="product-card mt-4">
            <h4 class="mb-4 fw-bold">Detail Produk</h4>

            <div class="d-flex align-items-start mb-3">
              <img src="{{ asset('storage/' . $data['transaksi']['produk']['image']) }}" alt="Mobile Legends" class="product-img me-3">
              <div>
                <span class="top-up-badge">{{ $data['produk']['categori']['name'] }}</span>
                <div class="fw-bold">{{ $data['produk']['item']}}</div>
                <div class="text-muted">{{ $data['produk']['game']['name'] }}</div>
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-4 label">Produk</div>
              <div class="col-8 value">{{ $data['produk']['categori']['name'] }}</div>
            </div>
            <div class="row mb-2">
              <div class="col-4 label">Nominal</div>
              <div class="col-8 value">{{ $data['produk']['item']}}</div>
            </div>
            <div class="row mb-2">
              <div class="col-4 label">User ID</div>
              <div class="col-8 value">{{ $data['transaksi']['transaksi']['game_id'] }} ({{ $data['transaksi']['transaksi']['zone_id'] }})</div>
            </div>
            <div class="row mb-2">
              <div class="col-4 label">Nickname</div>
              <div class="col-8 value">AlwaysDims &lt;/&gt;</div>
            </div>
            <div class="row mb-2">
              <div class="col-4 label">Jumlah</div>
              <div class="col-8 value">{{ $data['transaksi']['quantity'] }}</div>
            </div>
            <div class="row">
              <div class="col-4 label">No HP</div>
              <div class="col-8 value">{{ $data['transaksi']['transaksi']['no_telp'] }}</div>
            </div>
          </div>

      </div>

      <!-- Card catatan -->
      <div class="col-md-4 mt-5">
        <div class="product-card shadow-sm mt-5">
            <div class=" py-3">
                            <h6 class="fw-bold">Catatan : </h6>

                            <ol class="list-decimal" style="list-style: decimal; ">
                                <li class="text text-sm "><span class=" mr-1">1. </span>Salin no. transaksi jika tanpa login.</li>
                                <li class="text text-sm "><span class=" mr-1">2. </span>Halaman tidak perlu direfresh, status akan update otomatis.</li>
                                <li class="text text-sm "><span class=" mr-1">3. </span>Butuh bantuan? WhatsApp: 081280000203</li>
                                <li class="text text-sm "><span class=" mr-1">4. </span>Selesaikan pembayaran sebelum batas waktu.</li>
                                <li class="text text-sm "><span class=" mr-1">5. </span>Bayar sesuai nominal yang diminta.</li>
                                <li class="text text-sm "><span class=" mr-1">6. </span>Konfirmasi otomatis 1-5 menit setelah bayar.</li>
                                <li class="text text-sm "><span class=" mr-1">7. </span>Cek No hanphone untuk kode voucher jika membeli voucher.</li>
                            </ol>

            </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

@include('frontend.templates.footer')
