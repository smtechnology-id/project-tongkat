@extends('layouts.app')

@section('content')

@if ($proposal && $proposal->status_kelulusan != 'lulus')
<div class="alert alert-danger">
    Silahkan lengkapi proposal terlebih dahulu, Sampai status proposal menjadi <strong>Lulus</strong>
</div>
@else
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Pendaftaran Tugas Akhir</h5>
        <hr>
        <h5 class="mb-3">Riwayat Pendaftaran Ujian Tugas Akhir</h5>

        @if ($final_exams->count() < 1) <p>Silahkan isi form dibawah ini untuk melakukan pendaftaran ujian tugas akhir
            </p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pengajuan">
                Pendaftaran Ujian Tugas Akhir
            </button>
            @else
            @if ($final_exam->status == 'pending')
            <div class="card bg-warning">
                <div class="card-body">
                    <p class="card-text">Pendaftaran Ujian Tugas Akhir anda sedang menunggu konfirmasi dari Pihak
                        Admin / Panitia,
                        Silahkan
                        menunggu Sampai Status Pendaftaran berubah</p>
                    <p class="card-text">Catatan Dari Admin : {{ $final_exam->catatan_admin ?? '-' }}</p>
                </div>
            </div>
            @elseif ($final_exam->status == 'approved')
            <div class="card bg-primary">
                <div class="card-body">
                    <p class="card-text">Pendaftaran Ujian Tugas Akhir Anda Telah Disetujui, Silahkan Lanjutkan Ke
                        Tahap Selanjutnya</p>
                    <p class="card-text">Catatan Dari Admin : {{ $final_exam->catatan_admin ?? '-' }}</p>
                </div>
            </div>
            @elseif ($final_exam->status == 'rejected')
            <div class="card bg-danger">
                <div class="card-body">
                    <p class="card-text" style="color: white">Pendaftaran Ujian Tugas Akhir anda telah ditolak,
                        Silahkan Ajukan Pendaftaran Kembali</p>
                    <p class="card-text" style="color: white">Catatan Dari Admin :
                        {{ $final_exam->catatan_admin ?? '-' }}</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pengajuan">
                        Pendaftaran Ujian Tugas Akhir
                    </button>
                </div>
            </div>
            @endif
            @endif

            @if ($final_exam->status == 'approved')
            @if ($jadwal_exam == null)
            <div class="card bg-warning">
                <div class="card-body">
                    <p class="card-text">Jadwal Ujian Tugas Akhir Belum Ditentukan, Silahkan Menunggu Jadwal Dari Admin
                    </p>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3 text-center text-primary fw-bold">Jadwal Ujian Tugas Akhir</h5>
                    <p class="card-text">Jadwal Ujian Tugas Akhir Telah Ditentukan, Silahkan Cek Jadwal Dibawah Ini</p>
                    <p class="text-primary fw-bold">Judul Skripsi : {{ $jadwal_exam->finalExam->judul }}</p>
                    <table class="table table-bordered">
                        <tr>
                            <td>Nama Mahasiswa</td>
                            <td>:</td>
                            <td>{{ $jadwal_exam->user->name }}</td>
                        </tr>
                        <tr>
                            <td>Nama Dosen Pembimbing</td>
                            <td>:</td>
                            <td>{{ $jadwal_exam->finalExam->pembimbing_1 }} (Dosen Pembimbing 1), {{
                                $jadwal_exam->finalExam->pembimbing_2 }} (Dosen Pembimbing 2)</td>
                        </tr>
                        <tr>
                            <td>Penguji</td>
                            <td>:</td>
                            <td>{{ $jadwal_exam->finalExam->penguji_1 }} (Penguji 1), {{
                                $jadwal_exam->finalExam->penguji_2 }} (Penguji 2), {{ $jadwal_exam->finalExam->penguji_3
                                }} (Penguji 3)</td>
                        </tr>
                        <tr>
                            <td>Waktu Ujian</td>
                            <td>:</td>
                            <td>{{ $jadwal_exam->waktu }} ({{ $jadwal_exam->tanggal }})</td>
                        </tr>
                        <tr>
                            <td>Tempat Seminar</td>
                            <td>:</td>
                            <td>{{ $jadwal_exam->tempat }}</td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td>{{ $jadwal_exam->keterangan }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            @endif
            @endif
            <!-- Modal -->
            <div class="modal fade" id="pengajuan" tabindex="-1" aria-labelledby="pengajuanLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('user.examPost') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="pengajuanLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="judul">Judul <span class="text-danger">*</span></label>
                                    <input type="text" name="judul" id="judul" class="form-control" required
                                        placeholder="Masukkan Judul Skripsi" value="{{ $proposal->judul }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="dosen_pembimbing1">Dosen Pembimbing 1 <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="pembimbing_1" id="pembimbing_1" class="form-control"
                                        required placeholder="Masukkan Nama Dosen Pembimbing 1 Lengkap beserta gelar"
                                        value="{{ $proposal->pembimbing1 }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="dosen_pembimbing2">Dosen Pembimbing 2 <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="pembimbing_2" id="pembimbing_2" class="form-control"
                                        required placeholder="Masukkan Nama Dosen Pembimbing 2 Lengkap beserta gelar"
                                        value="{{ $proposal->pembimbing2 }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="penguji_1">Penguji 1 <span class="text-danger">*</span></label>
                                    <input type="text" name="penguji_1" id="penguji_1" class="form-control" required
                                        placeholder="Masukkan Nama Penguji 1 Lengkap beserta gelar"
                                        value="{{ $jadwal->dosen1 }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="penguji_2">Penguji 2 <span class="text-danger">*</span></label>
                                    <input type="text" name="penguji_2" id="penguji_2" class="form-control" required
                                        placeholder="Masukkan Nama Penguji 2 Lengkap beserta gelar"
                                        value="{{ $jadwal->dosen2 }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="penguji_3">Penguji 3 <span class="text-danger">*</span></label>
                                    <input type="text" name="penguji_3" id="penguji_3" class="form-control" required
                                        placeholder="Masukkan Nama Penguji 3 Lengkap beserta gelar"
                                        value="{{ $jadwal->dosen3 }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="file_1">File Skripsi <span class="text-danger">*</span></label>
                                    <input type="file" name="file_1" id="file" class="form-control" required
                                        accept="application/pdf">
                                    <small class="text-muted">File harus berformat PDF dan maksimal 10MB</small>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="file_2">Surat Keterangan Persetujuan Tugas Akhir <span
                                            class="text-danger">*</span></label>
                                    <input type="file" name="file_2" id="file_2" class="form-control" required
                                        accept="application/pdf">
                                    <small class="text-muted">File harus berformat PDF dan maksimal 1MB</small>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="file_3">Kartu Kehadiran Ujian Proposal Tugas Akhir <span
                                            class="text-danger">*</span></label>
                                    <input type="file" name="file_3" id="file_3" class="form-control" required
                                        accept="application/pdf">
                                    <small class="text-muted">File harus berformat PDF dan maksimal 1MB</small>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="file_4">Logbook Kegiatan Tugas Akhir <span
                                            class="text-danger">*</span></label>
                                    <input type="file" name="file_4" id="file_4" class="form-control" required
                                        accept="application/pdf">
                                    <small class="text-muted">File harus berformat PDF dan maksimal 1MB</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="datatable1" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Dosen Pembimbing 1</th>
                            <th>Dosen Pembimbing 2</th>
                            <th>Penguji 1</th>
                            <th>Penguji 2</th>
                            <th>Penguji 3</th>
                            <th>Dokumen Upload</th>
                            <th>Status</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($final_exams as $final_exam)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $final_exam->judul }}</td>
                            <td>{{ $final_exam->pembimbing_1 }}</td>
                            <td>{{ $final_exam->pembimbing_2 }}</td>
                            <td>{{ $final_exam->penguji_1 }}</td>
                            <td>{{ $final_exam->penguji_2 }}</td>
                            <td>{{ $final_exam->penguji_3 }}</td>
                            <td>
                                <!-- Button trigger modal -->
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
                                                        <td>Dokumen Skripsi</td>
                                                        <td>:</td>
                                                        <td><a target="_blank" class="btn btn-outline-primary"
                                                                href="{{ asset('storage/final_exam/' . $final_exam->file_1) }}">Download</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Surat Keterangan Persetujuan Tugas Akhir</td>
                                                        <td>:</td>
                                                        <td><a target="_blank" class="btn btn-outline-primary"
                                                                href="{{ asset('storage/final_exam/' . $final_exam->file_2) }}">Download</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kartu Kehadiran Ujian Proposal Tugas Akhir</td>
                                                        <td>:</td>
                                                        <td><a target="_blank" class="btn btn-outline-primary"
                                                                href="{{ asset('storage/final_exam/' . $final_exam->file_3) }}">Download</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Logbook Kegiatan Tugas Akhir</td>
                                                        <td>:</td>
                                                        <td><a target="_blank" class="btn btn-outline-primary"
                                                                href="{{ asset('storage/final_exam/' . $final_exam->file_4) }}">Download</a>
                                                        </td>
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
                                @if ($final_exam->status == 'pending')
                                <span class="badge bg-warning">Menunggu Konfirmasi Admin</span>
                                @elseif ($final_exam->status == 'approved')
                                <span class="badge bg-success">Disetujui</span>
                                @else
                                <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>{{ $final_exam->created_at->format('d-m-Y H:i:s') }}</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
    </div>
</div>
@endif
@endsection