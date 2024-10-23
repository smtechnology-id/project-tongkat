@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Pengaturan Jadwal Seminar Proposal</h5>

            <hr>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                        role="tab" aria-controls="home" aria-selected="true">Belum Terjadwal</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                        role="tab" aria-controls="profile" aria-selected="false">Sudah Terjadwal</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable1" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>NIM</th>
                                    <th>Judul</th>
                                    <th>Dosen Pembimbing 1</th>
                                    <th>Dosen Pembimbing 2</th>
                                    <th>Status</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($proposals as $proposal)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $proposal->user->name }}</td>
                                        <td>{{ $proposal->user->nim }}</td>
                                        <td>{{ $proposal->judul }}</td>
                                        <td>{{ $proposal->pembimbing1 }}</td>
                                        <td>{{ $proposal->pembimbing2 }}</td>

                                        <td>
                                            @if ($proposal->status == 'pending')
                                                <span class="badge bg-warning">Menunggu Konfirmasi Admin</span>
                                            @elseif ($proposal->status == 'approved')
                                                <span class="badge bg-success">Disetujui</span>
                                            @else
                                                <span class="badge bg-danger">Ditolak</span>
                                            @endif
                                        </td>
                                        <td>{{ $proposal->created_at->format('d-m-Y H:i:s') }}</td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#approve{{ $proposal->id }}">
                                                Buatkan Jadwal
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="approve{{ $proposal->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('admin.jadwal.proposal.store') }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Form
                                                                    Pembuatan Jadwal</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <input type="hidden" name="proposal_id"
                                                                    value="{{ $proposal->id }}">
                                                                <input type="hidden" name="user_id"
                                                                    value="{{ $proposal->user_id }}">
                                                                <div class="form-group mb-3">
                                                                    <label for="tanggal">Tanggal <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="date" name="tanggal"
                                                                        class="form-control" required>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="waktu">Waktu <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" name="waktu"
                                                                        class="form-control" required
                                                                        placeholder="Contoh: 10:00 - 12:00">
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="tempat">Tempat <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" name="tempat"
                                                                        class="form-control" required
                                                                        placeholder="Contoh: Ruang Seminar">
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="dosen1">Dosen penguji 1 <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" name="dosen1"
                                                                        class="form-control" required
                                                                        placeholder="Contoh: Dosen 1">
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="dosen2">Dosen penguji 2 <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" name="dosen2"
                                                                        class="form-control" required
                                                                        placeholder="Contoh: Dosen 2">
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="dosen3">Dosen penguji 3 <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" name="dosen3"
                                                                        class="form-control" required
                                                                        placeholder="Contoh: Dosen 3">
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="keterangan">Keterangan</label>
                                                                    <textarea name="keterangan" class="form-control" rows="3" required
                                                                        placeholder="Contoh: Jadwal akan diadakan pada tanggal 10-10-2024"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
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
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <table class="table table-bordered" id="datatable1" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>NIM</th>
                                <th>Judul</th>
                                <th>Waktu</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwal as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->proposal->user->name }}</td>
                                    <td>{{ $item->proposal->user->nim }}</td>
                                    <td>{{ $item->proposal->judul }}</td>
                                    <td>{{ $item->waktu }} - {{ $item->tanggal }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            Detail
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>Nama Mahasiswa</th>
                                                                <td>:</td>
                                                                <td>{{ $item->proposal->user->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>NIM</th>
                                                                <td>:</td>
                                                                <td>{{ $item->proposal->user->nim }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Judul</th>
                                                                <td>:</td>
                                                                <td>{{ $item->proposal->judul }}</td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <th>Waktu Seminar</th>
                                                                <td>:</td>
                                                                <td>{{ $item->waktu }} {{ $item->tanggal }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Tempat Seminar</th>
                                                                <td>:</td>
                                                                <td>{{ $item->tempat }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Dosen Pembimbing 1</th>
                                                                <td>:</td>
                                                                <td>{{ $item->proposal->pembimbing1 }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Dosen Pembimbing 2</th>
                                                                <td>:</td>
                                                                <td>{{ $item->proposal->pembimbing2 }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Dosen Penguji 1</th>
                                                                <td>:</td>
                                                                <td>{{ $item->dosen1 }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Dosen Penguji 2</th>
                                                                <td>:</td>
                                                                <td>{{ $item->dosen2 }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Dosen Penguji 3</th>
                                                                <td>:</td>
                                                                <td>{{ $item->dosen3 }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Keterangan</th>
                                                                <td>:</td>
                                                                <td>{{ $item->keterangan }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
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
@endsection
