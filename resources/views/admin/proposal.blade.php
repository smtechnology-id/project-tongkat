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
                                    <th>No HP</th>
                                    <th>Judul</th>
                                    <th>Dosen Pembimbing 1</th>
                                    <th>Dosen Pembimbing 2</th>
                                    <th>File</th>
                                    <th>Catatan</th>
                                    <th>Status</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pending as $pending)
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
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#approve{{ $pending->id }}">
                                                Approve
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#reject{{ $pending->id }}">
                                                Reject
                                            </button>

                                            <!-- Modal -->
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
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="catatan">Catatan</label>
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $pending->id }}">
                                                                    <textarea name="catatan_admin" id="catatan_admin" cols="30" rows="3" class="form-control"></textarea>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Setujui</button>
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
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="catatan">Catatan</label>
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $pending->id }}">
                                                                    <textarea name="catatan_admin" id="catatan_admin" cols="30" rows="3" class="form-control"></textarea>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Tolak</button>
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
                                    <th>Catatan Mahasiswa</th>
                                    <th>Catatan Admin</th>
                                    <th>Status</th>
                                    <th>Tanggal Pengajuan</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($approved as $approved)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $approved->user->name }}</td>
                                        <td>{{ $approved->user->nim }}</td>
                                        <td>{{ $approved->user->telephone }}</td>
                                        <td>{{ $approved->judul }}</td>
                                        <td>{{ $approved->pembimbing1 }}</td>
                                        <td>{{ $approved->pembimbing2 }}</td>
                                        <td>
                                            <a target="_blank" href="{{ asset('storage/file_proposal/' . $approved->file) }}"
                                                class="btn btn-primary">Download</a>
                                        </td>
                                        <td>{{ $approved->catatan_mahasiswa ?? '-' }}</td>
                                        <td>{{ $approved->catatan_admin ?? '-' }}</td>
                                        <td>
                                            @if ($approved->status == 'pending')
                                                <span class="badge bg-warning">Menunggu Konfirmasi Admin</span>
                                            @elseif ($approved->status == 'approved')
                                                <span class="badge bg-success">Disetujui</span>
                                            @else
                                                <span class="badge bg-danger">Ditolak</span>
                                            @endif
                                        </td>
                                        <td>{{ $approved->created_at->format('d-m-Y H:i:s') }}</td>
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
                                    <th>Catatan Mahasiswa</th>
                                    <th>Catatan Admin</th>
                                    <th>Status</th>
                                    <th>Tanggal Pengajuan</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rejected as $rejected)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $rejected->user->name }}</td>
                                        <td>{{ $rejected->user->nim }}</td>
                                        <td>{{ $rejected->user->telephone }}</td>
                                        <td>{{ $rejected->judul }}</td>
                                        <td>{{ $rejected->pembimbing1 }}</td>
                                        <td>{{ $rejected->pembimbing2 }}</td>
                                        <td>
                                            <a target="_blank" href="{{ asset('storage/file_proposal/' . $rejected->file) }}"
                                                class="btn btn-primary">Download</a>
                                        </td>
                                        <td>{{ $rejected->catatan_mahasiswa ?? '-' }}</td>
                                        <td>{{ $rejected->catatan_admin ?? '-' }}</td>
                                        <td>
                                            @if ($rejected->status == 'pending')
                                                <span class="badge bg-warning">Menunggu Konfirmasi Admin</span>
                                            @elseif ($rejected->status == 'approved')
                                                <span class="badge bg-success">Disetujui</span>
                                            @else
                                                <span class="badge bg-danger">Ditolak</span>
                                            @endif
                                        </td>
                                        <td>{{ $rejected->created_at->format('d-m-Y H:i:s') }}</td>
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
