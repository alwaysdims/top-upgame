@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>Scan QRIS</h2>
    <p>Nomor Transaksi: {{ $trx_number }}</p>
    <img src="{{ $qris_url }}" alt="QRIS Code" style="width:250px;height:250px;">
    <p class="mt-3">Silakan scan dengan aplikasi seperti GoPay, DANA, OVO, dll.</p>
</div>
@endsection
