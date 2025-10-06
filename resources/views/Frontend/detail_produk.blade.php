@include('frontend.templates.header')
@include('frontend.templates.navbar')
@section('title', 'Detail Produk | ')

<style>
    .diamond-input {
        display: none;
    }

    .diamond-card {
        border: 2px solid #e0e0e0;
        border-radius: 16px;
        padding: 15px;
        text-align: center;
        cursor: pointer;
        transition: 0.3s;
        background-color: #f9f9ff;
    }

    .diamond-input:checked + .diamond-card {
        border: 2px solid #6a0dad; /* Ungu terang */
        box-shadow: 0 0 0 2px rgba(106, 13, 173, 0.3);
        background-color: #ffffff;
    }

    .diamond-card:hover {
        border-color: #6a0dad88;
    }

    .payment-option {
        border: 2px solid #dee2e6;
        border-radius: 12px;
        padding: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        transition: 0.3s;
    }

    input[type="radio"]:checked+label {
        border-color: #4c00ff;
        box-shadow: 0 0 0 2px rgba(76, 0, 255, 0.2);
    }

    .form-check-input {
        display: none;
    }

    .payment-option-custom {
    display: block;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    }

    input[type="radio"]:checked + .payment-option-custom {
        border: 2px solid #7e5bef; /* warna ungu seperti pada gambar */
        box-shadow: 0 0 10px rgba(126, 91, 239, 0.3);
    }

</style>

{{-- <div class="container mt-5">
    p
</div> --}}
<div class="container mt-4">
    @if ($errors->any())
    @foreach ($errors->all() as $item )
    <div class="alert alert-danger alert-dismissible fade show  text-white " role="alert">
        <span class="alert-icon align-middle">
            <span class="material-symbols-rounded text-md">
                thumb_up_off_alt
            </span>
        </span>
            <span class="alert-text"><strong>Danger!</strong> {{ $item }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    </div>
    @endforeach

    @endif
    <div class="row">
        <div class="col-md-4 mt-5">
            <div class="card mt-5">
                <div class="card-body text-center">
                    <img src="{{ asset('storage/' . $data['cards']['card_to_game']['gambar']) }}" alt="Mobile Legends"
                        class="img-fluid mb-2" style="max-width: 150px; border-radius: 12px;">
                    <h5 class="card-title">{{ $data['cards']['card_to_game']['name'] }}</h5>
                    <span class="text-success fw-bold">{{ $data['cards']['card_to_category']['name'] }}</span>
                    <div class="mt-3">
                        <span class="text-warning">Great</span>
                        <span class="text-success">★★★★★</span>
                        <span>Trustpilot</span>
                    </div>
                    <ul class="list-group list-group-flush mt-3">
                        <li class="list-group mb-1">1. Masukkan User ID dan Zone ID kamu</li>
                        <li class="list-group mb-1">2. Contoh: 1234567 (1234)</li>
                        <li class="list-group mb-1">3. Pilih Nominal Diamonds yang kamu inginkan</li>
                        <li class="list-group mb-1">4. Selesaikan pembayaran</li>
                        <li class="list-group mb-1">5. Diamonds akan ditambahkan ke akun Mobile Legends</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8 mt-5">
            <div class="alert alert-warning mt-5" role="alert">
                ⚠️ Akun harus region Indonesia, tidak bisa untuk akun luar negeri!
            </div>
            <form action="{{ route('home.transaksi') }}" method="POST" enctype="multipart/form-data" class="">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="card-body text-center">
                            <h5 class="card-title mb-2">Isi Akun Game!</h5>

                            <!-- Form ditambahkan di sini -->
                            <div class="row">
                                <div class="col-md-6 ">
                                    <input type="text" class="form-control" name="user_id"
                                        placeholder="Masukkan User ID">
                                </div>
                                <div class="col-md-6 ">
                                    <input type="text" class="form-control" name="zone_id"
                                        placeholder="Masukkan Zone ID">
                                </div>
                            </div>
                            <!-- Akhir form -->

                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Top Up</h5>
                    </div>
                    <div class="container mt-4">
                        <h5><strong>Diamonds</strong></h5>
                        <div class="row g-3 py-3">
                          @foreach ($data['products'] as $index => $products)

                            <div class="col-6 col-md-3">
                                <input type="hidden" name="product_id" value="{{ $products['id'] }}" id="">
                              <input type="radio" class="diamond-input" value="{{ $products['id'] }}" name="pilihan" id="diamond{{ $index }}" data-price="{{ $products['price'] }}" autocomplete="off">
                              <label class="diamond-card d-block" for="diamond{{ $index }}">
                                <img src="{{ asset('storage/' . $products['image']) }}" alt="Produk"
                                    style="width: 40px;">
                                <div class="fw-bold mt-2">{{ $products['item'] }}</div>
                                <div class="text-muted small">{{ $products['description'] }}</div>
                                <div class="bg-light-subtle mt-2 py-1 rounded">
                                  <span class="text-danger fw-bold">
                                    Rp. {{ number_format($products['price'], 0, '.', '.') }}
                                  </span>
                                </div>
                              </label>
                            </div>
                          @endforeach
                        </div>
                      </div>

                </div>
                <div class="card mt-3 p-3">
                    <div class="container">
                        <h5><strong>Masukkan jumlah pembelian</strong></h5>
                        <input type="number" class="form-input mt-3 h-2 rounded w-100" value="1" name="jumlah" id="">
                    </div>
                </div>

                <div class="card mt-3 p-3">
                    <div class="container">
                        <h5><strong>Pilih metode Pembayaran</strong></h5>

                        <div class="row g-3 mt-3">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="metode" id="gopay" value="gopay">
                                    <label class="payment-option" for="gopay">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ '../../Front-end/' }}assets/images/GoPay.jpg" alt="gopay"
                                                width="32" class="me-2">
                                            <strong>GoPay</strong>
                                        </div>
                                        <input type="hidden" name="total" value="" >
                                        <div class="text-end fw-bold" id="harga-gopay"> Rp0.000</div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="metode" id="qris" value="qris">
                                    <label class="payment-option" for="qris">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ '../../Front-end/' }}assets/images/QRIS.jpg" alt="qris"
                                                width="32" class="me-2">
                                            <strong>QRIS</strong>
                                        </div>
                                        <div class="text-end fw-bold" id="harga-qris"> Rp0.00</div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><div class="card mt-3 p-3">
                    <div class="container">
                        <h5><strong>Masukkan Voucher</strong></h5>
                        <div class="row g-3 mt-3">
                            @foreach ($data['vouchers'] as $voucher )
                            <div class="col-md-6">
                                <input class="form-check-input d-none" type="radio" name="voucher" id="voucher-{{ $voucher['id'] }}" value="{{ $voucher['id'] }}">
                                <label class="payment-option-custom" for="voucher-{{ $voucher['id'] }}">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('Front-end/assets/images/voucher.jpg') }}" style="height: 100px; width: 100px;" alt="voucher-img" class="me-2">
                                        <strong class="ms-2">Discount</strong>
                                    </div>
                                    <input type="hidden" name="discount" value="{{ $voucher['discount_value'] }}" >
                                    <div class="text-end fw-bold mt-2"  >Rp {{ number_format($voucher['discount_value'], 0, '.', '.') }}</div>
                                </label>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
                <div class="card mt-3 p-3">
                    <div class="container">
                        <h5><strong>Contact yang bisa dihubungi</strong></h5>
                        <input type="text" class="form-input mt-3 h-2 rounded w-100" value="+62" name="no_telp" id="">
                    </div>
                </div>
                <div class="card mt-3 p-3">
                    <div class="container">

                        <h5><strong>Catatan : </strong><label for="" class="text text-danger text-lg">Pastikan data anda benar!</label></h5>
                        {{-- <label for="totalHarga" class="form-label"><strong>Total Harga</strong></label> --}}
                        <input type="hidden"  id="totalHarga" class="form-control" name="total">
                       <button type="submit" class="btn btn-primary btn-md mt-3 w-100">Beli</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const radios = document.querySelectorAll('input[name="pilihan"]');
        const jumlahInput = document.querySelector('input[name="jumlah"]');
        const hargaGopay = document.getElementById('harga-gopay');
        const hargaQris = document.getElementById('harga-qris');
        const totalInput = document.getElementById('totalHarga');

        let hargaPerItem = 0;

        function updateHarga() {
            const jumlah = parseInt(jumlahInput.value) || 0;
            const total = hargaPerItem * jumlah;

            const formatted = total.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });

            hargaGopay.textContent = formatted;
            hargaQris.textContent = formatted;
            totalInput.value = total; // Menampilkan total ke input
        }

        radios.forEach(radio => {
            radio.addEventListener('change', function () {
                hargaPerItem = parseInt(this.getAttribute('data-price')) || 0;
                updateHarga();
            });
        });

        jumlahInput.addEventListener('input', updateHarga);
    });
</script>


@include('frontend.templates.footer')
