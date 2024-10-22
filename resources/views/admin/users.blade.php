@extends('layouts.app')

@section('active_user', 'active-page')
@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Data Account Mahasiswa</h5>
        <div class="table-responsive">
            <table id="datatable1" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Telepon (Whatsapp)</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->nim }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->telephone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $user->id }}">
                                Update
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.user.update') }}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Data Mahasiswa
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                                                <div class="form-group mb-3">
                                                    <label for="name">Nama</label>
                                                    <input type="text" name="name" id="name" class="form-control"
                                                        value="{{ $user->name }}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="nim">NIM</label>
                                                    <input type="text" name="nim" id="nim" class="form-control"
                                                        value="{{ $user->nim }}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="telephone">Telepon (Whatsapp)</label>
                                                    <input type="text" name="telephone" id="telephone"
                                                        class="form-control" value="{{ $user->telephone }}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" id="email" class="form-control"
                                                        value="{{ $user->email }}">
                                                </div>
                                                {{-- Isi Jika ingin mengganti password --}}
                                                <hr>
                                                <p class="text-danger">Kosongkan Jika tidak ingin mengganti password</p>
                                                <div class="form-group mb-3">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" id="password"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="password_confirmation">Konfirmasi Password</label>
                                                    <input type="password" name="password_confirmation"
                                                        id="password_confirmation" class="form-control">
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
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
@endsection