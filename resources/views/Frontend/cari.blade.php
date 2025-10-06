@include('frontend.templates.header')
@include('frontend.templates.navbar')
@section('title', 'Cari Transaksi ')

<div class="container mt-5 py-5">
    <div class="card mt-5">
        <div class="card-body">
            <h4 class="text-center"><strong>Cari Transaksi</strong></h4>
            <form action="{{ route('home.cariTransaksi') }}" method="post" class="">
                @csrf
                <label for=""></label>
                <input type="text" class="form-control" name="transaction_code" id="" placeholder="isi code transaksi">
                <button type="submit" class="btn btn-md bg-success text-white mt-3 w-100">Kirim</button>
            </form>
        </div>
    </div>
</div>


@include('frontend.templates.footer')

