@extends('admin.layouts.template')
@section('title', 'Vouchers')
@section('content')

<div class="row py-3">
    <div class="col-12">
        <!-- Button trigger modal -->
        <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            Add voucher
        </button>

        <!-- Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Add voucher</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('vouchers.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Code</label>
                                    <div class="input-group input-group-outline">
                                        <input type="text" class="form-control" name="code" value="{{ $data['code'] }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Discount</label>
                                    <div class="input-group input-group-outline">
                                        <input type="text" class="form-control" name="discount_value" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Minimal pembelian</label>
                                    <div class="input-group input-group-outline">
                                        <input type="text" class="form-control" name="min_price" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Limit pemakaian</label>
                                    <div class="input-group input-group-outline">
                                        <input type="number" class="form-control" name="usage_limit" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal mulai</label>
                                    <div class="input-group input-group-outline">
                                        <input type="date" class="form-control" name="start_date" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal berakhir</label>
                                    <div class="input-group input-group-outline">
                                        <input type="date" class="form-control" name="end_date" >
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-gradient-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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
                    <h6 class="text-white text-capitalize ps-3">vouchers table</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>

                                <th class="text-uppercase text-secondary text-xxs text-center font-weight-bolder opacity-7">No
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Code Voucher
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">discount value
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">minimal pembelian
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">tanggal mulai
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">tanggal berakhir
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">limit pemakaian
                                </th>
                                <th class="text-secondary opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 0;
                            @endphp

                            @foreach ($data['vouchers'] as $vouchers )
                            @php
                            $no++;
                            @endphp
                            <tr>
                                <td>
                                    <p class="text-xs font-weight-bold text-center mb-0">{{ $no }}</p>
                                </td>

                                <td>
                                    <p class="text-xs font-weight-bold text-center mb-0">{{ $vouchers['code'] }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold text-center mb-0">Rp {{ number_format($vouchers['discount_value'],0,'.','.') }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold text-center mb-0">Rp {{ number_format($vouchers['min_price'],0,'.','.') }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold text-center mb-0">{{ $vouchers['start_date'] }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold text-center mb-0">{{ $vouchers['end_date'] }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold text-center mb-0">{{ $vouchers['usage_limit'] }}</p>
                                </td>

                                <td class="align-middle ">
                                    <button type="button" class="btn btn-weight-bold text-success"
                                        data-bs-toggle="modal" data-bs-target="#editUser{{ $vouchers['id'] }}">
                                        <i class="material-symbols-rounded">edit_square</i>
                                    </button>
                                    <a href="{{ route('vouchers.delete',$vouchers['id']) }}" class="btn text-danger btn-weight-bold" data-toggle="tooltip"
                                        data-original-title="Edit user" onclick="alert('Apakah yakin ingin menghapus data?')">
                                        <i class="material-symbols-rounded">delete</i>
                                    </a>
                                    <div class="modal fade" id="editUser{{ $vouchers['id'] }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title font-weight-normal" id="exampleModalLabel">
                                                        Edit vouchers</h5>
                                                    <button type="button" class="btn-close text-dark"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="{{ route('vouchers.update',$vouchers['id'] ) }}" enctype="multipart/form-data" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Code</label>
                                                                <div class="input-group input-group-outline">
                                                                    <input type="text" class="form-control" name="code" value="{{ $vouchers['code'] }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Discount</label>
                                                                <div class="input-group input-group-outline">
                                                                    <input type="text" class="form-control" name="discount_value" value="{{ $vouchers['discount_value'] }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Minimal pembelian</label>
                                                                <div class="input-group input-group-outline">
                                                                    <input type="text" class="form-control" name="min_price" value="{{ $vouchers['min_price'] }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Limit pemakaian</label>
                                                                <div class="input-group input-group-outline">
                                                                    <input type="number" class="form-control" name="usage_limit" value="{{ $vouchers['usage_limit'] }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Tanggal mulai</label>
                                                                <div class="input-group input-group-outline">
                                                                    <input type="date" class="form-control" name="start_date" value="{{ $vouchers['start_date'] }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Tanggal berakhir</label>
                                                                <div class="input-group input-group-outline">
                                                                    <input type="date" class="form-control" name="end_date" value="{{ $vouchers['end_date'] }}">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn bg-gradient-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn bg-gradient-primary">Save changes</button>
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
