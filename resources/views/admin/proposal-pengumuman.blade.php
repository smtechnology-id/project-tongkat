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
                                <th>File</th>
                                <th>Status Kelulusan</th>
                                <th>Detail</th>
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
                                <td>
                                    <a target="_blank" href="{{ asset('storage/file_proposal/' . $pending->file) }}"
                                        class="btn btn-link text-decoration-none btn-sm">Download</a>
                                </td>
                                
                                <td>
                                    @if ($pending->status_kelulusan == 'pending')
                                    <span class="badge bg-warning">Menunggu Konfirmasi Admin</span>
                                    @elseif ($pending->status_kelulusan == 'lulus')
                                    <span class="badge bg-success">Lulus</span>
                                    @else
                                    <span class="badge bg-danger">Tidak Lulus</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#detailPending{{ $pending->id }}">
                                        Detail
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="detailPending{{ $pending->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail Proposal</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                            <th>Catatan Admin</th>
                                                            <td>{{ $pending->catatan_admin ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tanggal Pengajuan</th>
                                                            <td>{{ $pending->created_at->format('d-m-Y H:i:s') }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                    <table class="table table-bordered" id="datatable4" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>NIM</th>
                                <th>File</th>
                                <th>Status Kelulusan</th>
                                <th>Detail</th>
                                <th>Tanggal Pengajuan</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lulus as $lulus)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $lulus->user->name }}</td>
                                <td>{{ $lulus->user->nim }}</td>
                                
                                <td>
                                    <a target="_blank" href="{{ asset('storage/file_proposal/' . $lulus->file) }}"
                                        class="btn btn-light btn-sm">Download</a>
                                </td>
                                <td>
                                    @if ($lulus->status_kelulusan == 'pending')
                                    <span class="badge bg-warning">Menunggu Konfirmasi Admin</span>
                                    @elseif ($lulus->status_kelulusan == 'lulus')
                                    <span class="badge bg-success">Lulus</span>
                                    @elseif ($lulus->status_kelulusan == 'tidak lulus')
                                    <span class="badge bg-danger">Tidak Lulus</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailLulus{{ $lulus->id }}">
                                        Detail
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="detailLulus{{ $lulus->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail Proposal</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>Nama Mahasiswa</th>
                                                            <td>{{ $lulus->user->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>NIM</th>
                                                            <td>{{ $lulus->user->nim }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Judul</th>
                                                            <td>{{ $lulus->judul }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Dosen Pembimbing 1</th>
                                                            <td>{{ $lulus->pembimbing1 }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Dosen Pembimbing 2</th>
                                                            <td>{{ $lulus->pembimbing2 }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Catatan Mahasiswa</th>
                                                            <td>{{ $lulus->catatan_mahasiswa ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Catatan Admin</th>
                                                            <td>{{ $lulus->catatan_admin ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tanggal Pengajuan</th>
                                                            <td>{{ $lulus->created_at->format('d-m-Y H:i:s') }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                    <table class="table table-bordered" id="datatable4" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>NIM</th>
                                <th>File</th>
                                <th>Status Kelulusan</th>
                                <th>Detail</th>
                                <th>Tanggal Pengajuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tidak_lulus as $tidak_lulus)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tidak_lulus->user->name }}</td>
                                <td>{{ $tidak_lulus->user->nim }}</td>
                                <td>
                                    <a target="_blank" href="{{ asset('storage/file_proposal/' . $tidak_lulus->file) }}"
                                        class="btn btn-light btn-sm">Download</a>
                                </td>
                                <td>
                                    @if ($tidak_lulus->status_kelulusan == 'pending')
                                    <span class="badge bg-warning">Menunggu Konfirmasi Admin</span>
                                    @elseif ($tidak_lulus->status_kelulusan == 'lulus')
                                    <span class="badge bg-success">Lulus</span>
                                    @elseif ($tidak_lulus->status_kelulusan == 'tidak lulus')
                                    <span class="badge bg-danger">Tidak Lulus</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailTidakLulus{{ $tidak_lulus->id }}">
                                        Detail
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="detailTidakLulus{{ $tidak_lulus->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail Proposal</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>Nama Mahasiswa</th>
                                                            <td>{{ $tidak_lulus->user->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>NIM</th>
                                                            <td>{{ $tidak_lulus->user->nim }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Judul</th>
                                                            <td>{{ $tidak_lulus->judul }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Dosen Pembimbing 1</th>
                                                            <td>{{ $tidak_lulus->pembimbing1 }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Dosen Pembimbing 2</th>
                                                            <td>{{ $tidak_lulus->pembimbing2 }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Catatan Mahasiswa</th>
                                                            <td>{{ $tidak_lulus->catatan_mahasiswa ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Catatan Admin</th>
                                                            <td>{{ $tidak_lulus->catatan_admin ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tanggal Pengajuan</th>
                                                            <td>{{ $tidak_lulus->created_at->format('d-m-Y H:i:s') }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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