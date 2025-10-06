@extends('admin.layouts.template')
@section('title', 'transaksi')
@section('content')

<div class="row py-3">
    <div class="col-12">
        <!-- Button trigger modal -->


        <!-- Modal -->


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
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        @if (session()->has('message'))

        <!-- Alert -->
        <div class="alert alert-success alert-dismissible fade show  text-white mb-3 " role="alert">
            <span class="alert-icon align-middle">
                <span class="material-symbols-rounded text-md">
                    thumb_up_off_alt
                </span>
            </span>
            <span class="alert-text"><strong>Success!</strong> {{ session('message') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>

        @endif

        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Invoice table</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">No
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NOTA
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ITEM
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">QUANTITY
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">TOTAL
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">STATUS TRSANSAKSI
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">STATUS PEMBAYARAN
                                </th>
                                <th class="text-secondary opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 0;
                            @endphp

                            @foreach ($data['transaksi'] as $transaksi )
                            @php
                            $no++;
                            @endphp
                            <tr>
                                <td>
                                    <p class="text-xs font-weight-bold text-center mb-0">{{ $no }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $transaksi['transaksi']['transaction_code'] }}</p>
                                </td>

                                <td>
                                    <div class="d-flex px-2">
                                        <div>
                                            <img src="{{ asset('storage/' . $transaksi['produk']['image']) }}" class="avatar avatar-sm rounded-circle me-2">
                                        </div>
                                        <div class="my-auto">
                                            <h6 class="mb-0 text-xs">{{ $transaksi['produk']['item'] }}</h6>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <p class="text-xs font-weight-bold mb-0 text-center">{{ $transaksi['quantity'] }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0 text-center">Rp {{ number_format($transaksi['subtotal'],0,'.','.') }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0 text-center">{{ $transaksi['status'] }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0 text-center">{{ $transaksi['transaksi']['status_pembayaran'] }}</p>
                                </td>

                                <td class="align-middle text-center">
                                    @if ($transaksi['status'] == 'Success')
                                    <button  class="btn btn-weight-bold text-success">

                                        <i class="material-symbols-rounded">done_all</i>
                                    </button>
                                    @else
                                        <button type="button" class="btn btn-weight-bold text-success"
                                            data-bs-toggle="modal" data-bs-target="#editUser{{ $transaksi['id'] }}">
                                            <i class="material-symbols-rounded">edit_square</i>
                                        </button>
                                    @endif

                                    <div class="modal fade" id="editUser{{ $transaksi['id'] }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title font-weight-normal" id="exampleModalLabel">
                                                       Cek bukti pembayaran</h5>
                                                    <button type="button" class="btn-close text-dark"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="{{ route('invoice.update' ) }}" enctype="multipart/form-data" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <input type="hidden" name="transaksi_id" value="{{ $transaksi['transaction_id'] }}" id="">
                                                        <div class="row">
                                                            <label class="form-label">Gambar</label>
                                                            <div class="col-md-12">
                                                                <img src="{{ asset('storage/' . $transaksi['transaksi']['picture']) }}"
                                                                     class="img-fluid img-thumbnail"
                                                                     style="width: 100%; height: 200px; object-fit: cover;"
                                                                     alt="Gambar Transaksi">
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer mt-3">
                                                            <button type="button" class="btn bg-gradient-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn bg-gradient-primary">Konfirmasi
                                                                </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
