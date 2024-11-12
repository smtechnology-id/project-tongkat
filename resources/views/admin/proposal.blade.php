@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Data Pengajuan Proposal Skripsi</h5>
        <table class="table table-borderless">
            <tr>
                <td>Pending</td>
                <td>:</td>
                <td>Pendaftaran Masuk, Perlu di Konfirmasi Oleh Admin</td>
            </tr>
            <tr>
                <td>Approved</td>
                <td>:</td>
                <td>Pendaftaran Telah Disetujui Oleh Admin, Perlu Di Buatkan Jadwal Seminar di Menu <a
                        href="{{ route('admin.jadwal.proposal') }}">Jadwal Seminar Proposal</a></td>
            </tr>
            <tr>
                <td>Rejected</td>
                <td>:</td>
                <td>Pendaftaran Telah Ditolak Oleh Admin, Mahasiswa Dapat Mengajukan Proposal Kembali di Dashboard User
                    di Menu Proposal</td>
            </tr>
        </table>
        <hr>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true">Pending</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                    role="tab" aria-controls="profile" aria-selected="false">Approved</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button"
                    role="tab" aria-controls="contact" aria-selected="false">Rejected</button>
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
                                <th>File</th>
                                <th>Status</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Detail</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pending as $pending)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pending->user->name }}</td>
                                <td>{{ $pending->user->nim }}</td>
                                <td>
                                    <a target="_blank" href="{{ asset('storage/file_proposal/' . $pending->file) }}"
                                        class="btn btn-link">Download</a>
                                </td>
                                <td>
                                    @if ($pending->status == 'pending')
                                    <span class="badge bg-warning">Menunggu Konfirmasi Admin</span>
                                    @elseif ($pending->status == 'approved')
                                    <span class="badge bg-success">Disetujui</span>
                                    @else
                                    <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>{{ $pending->created_at->format('d-m-Y H:i:s') }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#detailPending{{ $pending->id }}">
                                        Detail
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="detailPending{{ $pending->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail Proposal
                                                        Pendaftaran</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>Nama Mahasiswa</th>
                                                            <td>{{ $pending->user->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>NIM</th>
                                                            <td>{{ $pending->user->nim }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>No HP</th>
                                                            <td>{{ $pending->user->telephone }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Judul</th>
                                                            <td>{{ $pending->judul }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Dosen Pembimbing 1</th>
                                                            <td>{{ $pending->pembimbing1 }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Dosen Pembimbing 2</th>
                                                            <td>{{ $pending->pembimbing2 }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Catatan Mahasiswa</th>
                                                            <td>{{ $pending->catatan_mahasiswa ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tanggal Pengajuan</th>
                                                            <td>{{ $pending->created_at->format('d-m-Y H:i:s') }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-warning btn-sm mt-2" data-bs-toggle="modal"
                                        data-bs-target="#update{{ $pending->id }}">
                                        Update
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm mt-2" data-bs-toggle="modal"
                                        data-bs-target="#approve{{ $pending->id }}">
                                        Approve
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm mt-2" data-bs-toggle="modal"
                                        data-bs-target="#reject{{ $pending->id }}">
                                        Reject
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="update{{ $pending->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.proposal.update') }}" method="post">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update
                                                            Proposal
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" value="{{ $pending->id }}">
                                                        <div class="form-group">
                                                            <label for="judul">Judul</label>
                                                            <input type="hidden" name="id" value="{{ $pending->id }}">
                                                            <input type="text" name="judul" id="judul"
                                                                class="form-control" value="{{ $pending->judul }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="pembimbing1">Dosen Pembimbing 1</label>
                                                            <input type="text" name="pembimbing1" id="pembimbing1"
                                                                class="form-control"
                                                                value="{{ $pending->pembimbing1 }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="pembimbing2">Dosen Pembimbing 2</label>
                                                            <input type="text" name="pembimbing2" id="pembimbing2"
                                                                class="form-control"
                                                                value="{{ $pending->pembimbing2 }}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="approve{{ $pending->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.proposal.approve') }}" method="post">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Setujui
                                                            Proposal
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="catatan">Catatan</label>
                                                            <input type="hidden" name="id" value="{{ $pending->id }}">
                                                            <textarea name="catatan_admin" id="catatan_admin" cols="30"
                                                                rows="3" class="form-control"></textarea>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Setujui</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="reject{{ $pending->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.proposal.reject') }}" method="post">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Tolak
                                                            Proposal
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="catatan">Catatan</label>
                                                            <input type="hidden" name="id" value="{{ $pending->id }}">
                                                            <textarea name="catatan_admin" id="catatan_admin" cols="30"
                                                                rows="3" class="form-control"></textarea>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Tolak</button>
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
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable4" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>NIM</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($approved as $approve)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $approve->user->name }}</td>
                                <td>{{ $approve->user->nim }}</td>
                                <td>
                                    <a target="_blank" href="{{ asset('storage/file_proposal/' . $approve->file) }}"
                                        class="btn btn-link">Download</a>
                                </td>
                                <td>
                                    @if ($approve->status == 'pending')
                                    <span class="badge bg-warning">Menunggu Konfirmasi Admin</span>
                                    @elseif ($approve->status == 'approved')
                                    <span class="badge bg-success">Disetujui</span>
                                    @else
                                    <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>{{ $approve->created_at->format('d-m-Y H:i:s') }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#detailApproved{{ $approve->id }}">
                                        Detail
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="detailApproved{{ $approve->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail Proposal Telah
                                                        Disetujui</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>Nama Mahasiswa</th>
                                                            <td>{{ $approve->user->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>NIM</th>
                                                            <td>{{ $approve->user->nim }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>No HP</th>
                                                            <td>{{ $approve->user->telephone }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Judul</th>
                                                            <td>{{ $approve->judul }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Dosen Pembimbing 1</th>
                                                            <td>{{ $approve->pembimbing1 }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Dosen Pembimbing 2</th>
                                                            <td>{{ $approve->pembimbing2 }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Catatan Admin</th>
                                                            <td>{{ $approve->catatan_admin ?? 'Tidak ada catatan' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Catatan Mahasiswa</th>
                                                            <td>{{ $approve->catatan_mahasiswa ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tanggal Pengajuan</th>
                                                            <td>{{ $approve->created_at->format('d-m-Y H:i:s') }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
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
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable1" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>NIM</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rejected as $reject)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $reject->user->name }}</td>
                                <td>{{ $reject->user->nim }}</td>
                                <td>
                                    <a target="_blank" href="{{ asset('storage/file_proposal/' . $reject->file) }}"
                                        class="btn btn-link">Download</a>
                                </td>
                                <td>
                                    @if ($reject->status == 'pending')
                                    <span class="badge bg-warning">Menunggu Konfirmasi Admin</span>
                                    @elseif ($reject->status == 'approved')
                                    <span class="badge bg-success">Disetujui</span>
                                    @else
                                    <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>{{ $reject->created_at->format('d-m-Y H:i:s') }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#detailRejected{{ $reject->id }}">
                                        Detail
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="detailRejected{{ $reject->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail Proposal Telah
                                                        Ditolak</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>Nama Mahasiswa</th>
                                                            <td>{{ $reject->user->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>NIM</th>
                                                            <td>{{ $reject->user->nim }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>No HP</th>
                                                            <td>{{ $reject->user->telephone }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Judul</th>
                                                            <td>{{ $reject->judul }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Dosen Pembimbing 1</th>
                                                            <td>{{ $reject->pembimbing1 }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Dosen Pembimbing 2</th>
                                                            <td>{{ $reject->pembimbing2 }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Catatan Admin</th>
                                                            <td>{{ $reject->catatan_admin ?? 'Tidak ada catatan' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Catatan Mahasiswa</th>
                                                            <td>{{ $reject->catatan_mahasiswa ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tanggal Pengajuan</th>
                                                            <td>{{ $reject->created_at->format('d-m-Y H:i:s') }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
@endsection