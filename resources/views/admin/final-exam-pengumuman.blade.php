@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Pengumuman Ujian Tugas Akhir</h5>
            <table class="table table-borderless">
                <tr>
                    <td>Lulus</td>
                    <td>:</td>
                    <td>Ujian Tugas Akhir Lulus, Mahasiswa Dapat Mengisi Dokumen Final</td>
                </tr>
                <tr>
                    <td>Tidak Lulus</td>
                    <td>:</td>
                    <td>Ujian Tugas Akhir Tidak Lulus, Mahasiswa Dapat Mengajukan Ujian Kembali di Dashboard User di
                        Menu    </td>
                </tr>
                <tr>
                    <td>Pending</td>
                    <td>:</td>
                    <td>Mahasiswa Mendaftar Ujian Tugas Akhir, Menunggu Status Kelulusan Dari Admin</td>
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
                                    <th>Dosen Pembimbing</th>
                                    <th>Dosen Penguji</th>
                                    <th>File</th>
                                    <th>Status Kelulusan</th>
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
                                        <td>
                                            <ul>
                                                <li>{{ $pending->pembimbing_1 }}</li>
                                                <li>{{ $pending->pembimbing_2 }}</li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li>{{ $pending->penguji_1 }}</li>
                                                <li>{{ $pending->penguji_2 }}</li>
                                                <li>{{ $pending->penguji_3 }}</li>
                                            </ul>
                                        </td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#file{{ $pending->id }}">
                                                Lihat File
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="file{{ $pending->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Dokumen Persyaratan Ujian Tugas Akhir</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-bordered">
                                                                <tr>
                                                                    <td>File Skripsi</td>
                                                                    <td>:</td>
                                                                    <td><a href="{{ asset('storage/final_exam/' . $pending->file_1) }}"
                                                                            target="_blank">File Skripsi</a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Surat Keterangan Persetujuan Tugas Akhir</td>
                                                                    <td>:</td>
                                                                    <td><a href="{{ asset('storage/final_exam/' . $pending->file_2) }}"
                                                                            target="_blank">Surat Keterangan Persetujuan Tugas Akhir</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Kartu Kehadiran Ujian Proposal Tugas Akhir</td>
                                                                    <td>:</td>
                                                                    <td><a href="{{ asset('storage/final_exam/' . $pending->file_3) }}"
                                                                            target="_blank">Kartu Kehadiran Ujian Proposal Tugas
                                                                            Akhir</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Logbook Kegiatan Tugas Akhir</td>
                                                                    <td>:</td>
                                                                    <td><a href="{{ asset('storage/final_exam/' . $pending->file_4) }}"
                                                                            target="_blank">Logbook Kegiatan Tugas Akhir</a>
                                                                    </td>
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
                                                            <form action="{{ route('admin.final-exam.lulus') }}"
                                                                method="post">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $pending->id }}">
                                                                <button type="submit"
                                                                    class="btn btn-success">Luluskan</button>
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
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <p>Apakah anda yakin untuk mentidakluluskan proposal ini?
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <form action="{{ route('admin.final-exam.tidak-lulus') }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $pending->id }}">
                                                                    <button type="submit" class="btn btn-danger">Tidak
                                                                        Lulus</button>
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
                                    <th>Dosen Pembimbing</th>
                                    <th>Dosen Penguji</th>
                                    <th>File</th>
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
                                        <td>
                                            <ul>
                                                <li>{{ $lulus->pembimbing_1 }}</li>
                                                <li>{{ $lulus->pembimbing_2 }}</li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li>{{ $lulus->penguji_1 }}</li>
                                                <li>{{ $lulus->penguji_2 }}</li>
                                                <li>{{ $lulus->penguji_3 }}</li>
                                            </ul>
                                        </td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#file{{ $lulus->id }}">
                                                Lihat File
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="file{{ $lulus->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Dokumen Persyaratan Ujian Tugas Akhir</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-bordered">
                                                                <tr>
                                                                    <td>File Skripsi</td>
                                                                    <td>:</td>
                                                                    <td><a href="{{ asset('storage/final_exam/' . $lulus->file_1) }}"
                                                                            target="_blank">File Skripsi</a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Surat Keterangan Persetujuan Tugas Akhir</td>
                                                                    <td>:</td>
                                                                    <td><a href="{{ asset('storage/final_exam/' . $lulus->file_2) }}"
                                                                            target="_blank">Surat Keterangan Persetujuan Tugas Akhir</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Kartu Kehadiran Ujian Proposal Tugas Akhir</td>
                                                                    <td>:</td>
                                                                    <td><a href="{{ asset('storage/final_exam/' . $lulus->file_3) }}"
                                                                            target="_blank">Kartu Kehadiran Ujian Proposal Tugas
                                                                            Akhir</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Logbook Kegiatan Tugas Akhir</td>
                                                                    <td>:</td>
                                                                    <td><a href="{{ asset('storage/final_exam/' . $lulus->file_4) }}"
                                                                            target="_blank">Logbook Kegiatan Tugas Akhir</a>
                                                                    </td>
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
                                        <td>
                                            @if ($lulus->status_kelulusan == 'pending')
                                                <span class="badge bg-warning">Menunggu Konfirmasi Admin</span>
                                            @elseif ($lulus->status_kelulusan == 'lulus')
                                                <span class="badge bg-success">Lulus</span>
                                            @else
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
                                    <th>Dosen Pembimbing</th>
                                    <th>Dosen Penguji</th>
                                    <th>File</th>
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
                                        <td>
                                            <ul>
                                                <li>{{ $tidak_lulus->pembimbing_1 }}</li>
                                                <li>{{ $tidak_lulus->pembimbing_2 }}</li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li>{{ $tidak_lulus->penguji_1 }}</li>
                                                <li>{{ $tidak_lulus->penguji_2 }}</li>
                                                <li>{{ $tidak_lulus->penguji_3 }}</li>
                                            </ul>
                                        </td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#file{{ $tidak_lulus->id }}">
                                                Lihat File
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="file{{ $tidak_lulus->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Dokumen Persyaratan Ujian Tugas Akhir</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-bordered">
                                                                <tr>
                                                                    <td>File Skripsi</td>
                                                                    <td>:</td>
                                                                    <td><a href="{{ asset('storage/final_exam/' . $tidak_lulus->file_1) }}"
                                                                            target="_blank">File Skripsi</a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Surat Keterangan Persetujuan Tugas Akhir</td>
                                                                    <td>:</td>
                                                                    <td><a href="{{ asset('storage/final_exam/' . $tidak_lulus->file_2) }}"
                                                                            target="_blank">Surat Keterangan Persetujuan Tugas Akhir</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Kartu Kehadiran Ujian Proposal Tugas Akhir</td>
                                                                    <td>:</td>
                                                                    <td><a href="{{ asset('storage/final_exam/' . $tidak_lulus->file_3) }}"
                                                                            target="_blank">Kartu Kehadiran Ujian Proposal Tugas
                                                                            Akhir</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Logbook Kegiatan Tugas Akhir</td>
                                                                    <td>:</td>
                                                                    <td><a href="{{ asset('storage/final_exam/' . $tidak_lulus->file_4) }}"
                                                                            target="_blank">Logbook Kegiatan Tugas Akhir</a>
                                                                    </td>
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
