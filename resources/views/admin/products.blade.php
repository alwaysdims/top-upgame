@extends('admin.layouts.template')
@section('title', 'Products')
@section('content')

<div class="row py-3">
    <div class="col-12">
        <!-- Button trigger modal -->
        <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            Add Produk
        </button>

        <!-- Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Add Produk</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Item</label>
                                        <input type="text" class="form-control" name="item">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Harga</label>
                                        <input type="number" class="form-control" name="price">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Description</label>
                                        <input type="text" class="form-control" name="description">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Stock</label>
                                        <input type="number" class="form-control" name="stock">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Brand</label>
                                    <div class="input-group input-group-outline">
                                        <select class="form-control" name="brand_id">
                                            @foreach ($data['games'] as $brands )
                                                <option value="{{ $brands['id'] }}" class="form-control">{{ $brands['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Kategori</label>
                                    <div class="input-group input-group-outline">
                                        <select class="form-control" name="categori_id">
                                            @foreach ($data['categorys'] as $kategori )
                                                <option value="{{ $kategori['id'] }}" class="form-control">{{ $kategori['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Gambar</label>
                                    <div class="input-group input-group-outline">
                                        <input type="file" class="form-control" name="image">
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
                    <h6 class="text-white text-capitalize ps-3">products table</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7">No
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Item
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder  text-center  opacity-7">Price
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder  text-center  opacity-7">Game
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center  opacity-7">Categori
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center  opacity-7">Stock
                                </th>
                                <th class="text-secondary opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 0;
                            @endphp

                            @foreach ($data['produk'] as $products )
                            @php
                            $no++;
                            @endphp
                            <tr>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0 text-center">{{ $no }}</p>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1  ">
                                        <div>
                                            <img src="{{ asset('storage/' . $products['image']) }}" class="avatar avatar-sm me-3">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-xs">{{ $products['item'] }}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ $products['description'] }}</p>
                                          </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="badge badge-sm bg-gradient-success">Rp. {{ number_format($products['price'],0,'.','.') }}</span>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0 text-center ">{{ $products['game']['name'] }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0 text-center ">{{ $products['categori']['name'] }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0 text-center ">{{ $products['stock'] }}</p>
                                </td>

                                <td class="align-middle ">
                                    <button type="button" class="btn btn-weight-bold text-success"
                                        data-bs-toggle="modal" data-bs-target="#editUser{{ $products['id'] }}">
                                        <i class="material-symbols-rounded">edit_square</i>
                                    </button>
                                    <a href="{{ route('products.delete',$products['id']) }}" class="btn text-danger btn-weight-bold" data-toggle="tooltip"
                                        data-original-title="Edit user" onclick="alert('Apakah yakin ingin menghapus data?')">
                                        <i class="material-symbols-rounded">delete</i>
                                    </a>
                                    <div class="modal fade" id="editUser{{ $products['id'] }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title font-weight-normal" id="exampleModalLabel">
                                                        Edit products</h5>
                                                    <button type="button" class="btn-close text-dark"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="{{ route('products.update',$products['id'] ) }}" enctype="multipart/form-data" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Item</label>
                                                                <div class="input-group input-group-outline ">
                                                                    <input type="text" class="form-control" name="item" value="{{ $products['item'] }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Harga</label>
                                                                <div class="input-group input-group-outline ">
                                                                    <input type="number" class="form-control" name="price" value="{{ $products['price'] }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Description</label>
                                                                <div class="input-group input-group-outline ">
                                                                    <input type="text" class="form-control" name="description" value="{{ $products['description'] }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Stock</label>
                                                                <div class="input-group input-group-outline ">
                                                                    <input type="number" class="form-control" name="stock" value="{{ $products['stock'] }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="form-label">Brand</label>
                                                                <div class="input-group input-group-outline">
                                                                    <select class="form-control" name="brand_id">
                                                                        @foreach ($data['games'] as $brands )
                                                                            <option value="{{ $brands['id'] }}" class="form-control">{{ $brands['name'] }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="form-label">Kategori</label>
                                                                <div class="input-group input-group-outline">
                                                                    <select class="form-control" name="category_id">
                                                                        @foreach ($data['categorys'] as $kategori )
                                                                            <option value="{{ $kategori['id'] }}" class="form-control">{{ $kategori['name'] }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="form-label">Gambar</label>
                                                                <div class="input-group input-group-outline">
                                                                    <input type="file" class="form-control" name="image" value="{{ $products['image'] }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer mt-3">
                                                            <button type="button" class="btn bg-gradient-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn bg-gradient-primary">Save
                                                                changes</button>
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
