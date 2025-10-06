@extends('admin.layouts.template')
@section('title', 'Users')
@section('content')

<div class="row py-3">
    <div class="col-12">
        <!-- Button trigger modal -->
        <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            Add Users
        </button>

        <!-- Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Add Users</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control" name="username">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">No Telephone</label>
                                        <input type="number" class="form-control" name="no_telepon">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Alamat</label>
                                        <input type="text" class="form-control" name="alamat">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Role</label>
                                    <div class="input-group input-group-outline">
                                        <select class="form-control" name="role">
                                            <option value="Super admin" class="form-control">Super admin</option>
                                            <option value="Admin" class="form-control">Admin</option>
                                            <option value="User" class="form-control">User</option>
                                        </select>
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
                    <h6 class="text-white text-capitalize ps-3">Users table</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Username</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Email</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Alamat</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    No telephone</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Role</th>
                                <th class="text-secondary opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 0;
                            @endphp

                            @foreach ($data as $users )
                            @php
                            $no++;
                            @endphp
                            <tr>
                                <td>
                                    <p class="text-xs font-weight-bold text-center mb-0">{{ $no }}</p>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $users['name'] }}</h6>
                                            </div>
                                        </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $users['username'] }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="text-secondary text-xs font-weight-bold ">{{ $users['email'] }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $users['alamat'] }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span
                                        class="text-secondary text-xs font-weight-bold">{{ $users['no_telepon'] }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="badge badge-sm bg-gradient-success">{{ $users['role'] }}</span>
                                </td>
                                <td class="align-middle ">
                                    <button type="button" class="btn btn-weight-bold text-success"
                                        data-bs-toggle="modal" data-bs-target="#editUser{{ $users['id'] }}">
                                        <i class="material-symbols-rounded">edit_square</i>
                                    </button>
                                    <div class="modal fade" id="editUser{{ $users['id'] }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title font-weight-normal" id="exampleModalLabel">
                                                        Edit Users</h5>
                                                    <button type="button" class="btn-close text-dark"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="{{ route('users.update',$users['id'] ) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Name</label>
                                                                <div class="input-group input-group-outline ">
                                                                    <input type="text" class="form-control" name="name" value="{{ $users['name'] }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Username</label>
                                                                <div class="input-group input-group-outline ">
                                                                    <input type="text" class="form-control"
                                                                        name="username" disabled value="{{ $users['username'] }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Email</label>
                                                                <div class="input-group input-group-outline ">
                                                                    <input type="email" class="form-control"
                                                                        name="email" disabled value="{{ $users['email'] }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">No Telephone</label>
                                                                <div class="input-group input-group-outline ">
                                                                    <input type="number" class="form-control"
                                                                        name="no_telepon" value="{{ $users['no_telepon'] }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label class="form-label">Alamat</label>
                                                                <div class="input-group input-group-outline ">
                                                                    <input type="text" class="form-control"
                                                                        name="alamat" value="{{ $users['alamat'] }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="form-label">Role</label>
                                                                <div class="input-group input-group-outline">
                                                                    <select class="form-control" name="role">
                                                                        <option value="Super admin"
                                                                            class="form-control">Super admin</option>
                                                                        <option value="Admin" class="form-control">Admin
                                                                        </option>
                                                                        <option value="User" class="form-control">User
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
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
                                    <a href="{{ route('users.delete',$users['id']) }}" class="btn text-danger btn-weight-bold" data-toggle="tooltip"
                                        data-original-title="Edit user" onclick="alert('Apakah yakin ingin menghapus data?')">
                                        <i class="material-symbols-rounded">delete</i>
                                    </a>
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
