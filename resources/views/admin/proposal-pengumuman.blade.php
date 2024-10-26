@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Pengumuman Proposal Skripsi</h5>
        <table class="table table-borderless">
            <tr>
                <td>Lulus</td>
                <td>:</td>
                <td>Proposal Skripsi Telah Lulus, Mahasiswa Dapat Mengisi Formulir Ujian Tugas Akhir</td>
            </tr>
            <tr>
                <td>Tidak Lulus</td>
                <td>:</td>
                <td>Proposal Skripsi Telah Tidak Lulus, Mahasiswa Dapat Mengajukan Proposal Kembali di Dashboard User di
                    Menu Proposal</td>
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
                    role="tab" aria-controls="profile" aria-selected="false">Lulus</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button"
                    role="tab" aria-controls="contact" aria-selected="false">Tidak Lulus</button>
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
                                <th>No HP</th>
                                <th>Judul</th>
                                <th>Dosen Pembimbing 1</th>
                                <th>Dosen Pembimbing 2</th>
                                <th>File</th>
                                <th>Catatan</th>
                                <th>Status Kelulusan</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proposals as $pending)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pending->user->name }}</td>
                                <td>{{ $pending->user->nim }}</td>
                                <td>{{ $pending->user->telephone }}</td>
                                <td>{{ $pending->judul }}</td>
                                <td>{{ $pending->pembimbing1 }}</td>
                                <td>{{ $pending->pembimbing2 }}</td>
                                <td>
                                    <a target="_blank" href="{{ asset('file_proposal/' . $pending->file) }}"
                                        class="btn btn-primary">Download</a>
                                </td>
                                <td>{{ $pending->catatan_mahasiswa }}</td>
                                <td>
                                    @if ($pending->status_kelulusan == 'pending')
                                    <span class="badge bg-warning">Menunggu Konfirmasi Admin</span>
                                    @elseif ($pending->status_kelulusan == 'lulus')
                                    <span class="badge bg-success">Lulus</span>
                                    @else
                                    <span class="badge bg-danger">Tidak Lulus</span>
                                    @endif
                                </td>
                                <td>{{ $pending->created_at->format('d-m-Y H:i:s') }}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#approve{{ $pending->id }}">
                                        Luluskan
                                    </button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#reject{{ $pending->id }}">
                                        Tidak Lulus
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="approve{{ $pending->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        Kelulusan Proposal
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin Meluluskan proposal ini?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('admin.proposal.lulus') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $pending->id }}">
                                                        <button type="submit" class="btn btn-success">Luluskan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="reject{{ $pending->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tidak Luluskan
                                                        Proposal
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <p>Apakah anda yakin untuk mentidakluluskan proposal ini?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <form action="{{ route('admin.proposal.tidak-lulus') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $pending->id }}">
                                                            <button type="submit" class="btn btn-danger">Tidak Lulus</button>
                                                        </form>
                                                    </div>
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
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable1" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>NIM</th>
                                <th>No HP</th>
                                <th>Judul</th>
                                <th>Dosen Pembimbing 1</th>
                                <th>Dosen Pembimbing 2</th>
                                <th>File</th>
                                <th>Catatan</th>
                                <th>Status Kelulusan</th>
                                <th>Tanggal Pengajuan</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lulus as $lulus)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $lulus->user->name }}</td>
                                <td>{{ $lulus->user->nim }}</td>
                                <td>{{ $lulus->user->telephone }}</td>
                                <td>{{ $lulus->judul }}</td>
                                <td>{{ $lulus->pembimbing1 }}</td>
                                <td>{{ $lulus->pembimbing2 }}</td>
                                <td>
                                    <a target="_blank" href="{{ asset('file_proposal/' . $lulus->file) }}"
                                        class="btn btn-primary">Download</a>
                                </td>
                                <td>{{ $lulus->catatan_mahasiswa }}</td>
                                <td>
                                    @if ($lulus->status_kelulusan == 'pending')
                                    <span class="badge bg-warning">Menunggu Konfirmasi Admin</span>
                                    @elseif ($lulus->status_kelulusan == 'lulus')
                                    <span class="badge bg-success">Lulus</span>
                                    @elseif ($lulus->status_kelulusan == 'tidak lulus')
                                    <span class="badge bg-danger">Tidak Lulus</span>
                                    @endif
                                </td>
                                <td>{{ $lulus->created_at->format('d-m-Y H:i:s') }}</td>
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
                                <th>No HP</th>
                                <th>Judul</th>
                                <th>Dosen Pembimbing 1</th>
                                <th>Dosen Pembimbing 2</th>
                                <th>File</th>
                                <th>Catatan</th>
                                <th>Status Kelulusan</th>
                                <th>Tanggal Pengajuan</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tidak_lulus as $tidak_lulus)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tidak_lulus->user->name }}</td>
                                <td>{{ $tidak_lulus->user->nim }}</td>
                                <td>{{ $tidak_lulus->user->telephone }}</td>
                                <td>{{ $tidak_lulus->judul }}</td>
                                <td>{{ $tidak_lulus->pembimbing1 }}</td>
                                <td>{{ $tidak_lulus->pembimbing2 }}</td>
                                <td>
                                    <a target="_blank" href="{{ asset('file_proposal/' . $tidak_lulus->file) }}"
                                        class="btn btn-primary">Download</a>
                                </td>
                                <td>{{ $tidak_lulus->catatan_mahasiswa }}</td>
                                <td>
                                    @if ($tidak_lulus->status_kelulusan == 'pending')
                                    <span class="badge bg-warning">Menunggu Konfirmasi Admin</span>
                                    @elseif ($tidak_lulus->status_kelulusan == 'lulus')
                                    <span class="badge bg-success">Lulus</span>
                                    @else
                                    <span class="badge bg-danger">Tidak Lulus</span>
                                    @endif
                                </td>
                                <td>{{ $tidak_lulus->created_at->format('d-m-Y H:i:s') }}</td>
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