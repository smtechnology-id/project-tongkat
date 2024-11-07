@extends('layouts.app')

@section('content')
    @if (!$proposal)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pendaftaran Ujian Tugas Akhir</h5>
                <div class="alert alert-danger">
                    <p>Anda belum mengajukan proposal</p>
                </div>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body">
                @if ($proposal->status_kelulusan != 'lulus')
                    <div class="alert alert-danger">
                        Silahkan lengkapi proposal terlebih dahulu, Sampai status proposal menjadi <strong>Lulus</strong>
                    </div>
                @elseif (!$final_exam)
                    <div class="alert alert-danger">
                        Belum ada data pendaftaran ujian
                    </div>

                    <p>Silahkan isi form dibawah ini untuk melakukan pendaftaran ujian tugas akhir
                    </p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pengajuan">
                        Pendaftaran Ujian Tugas Akhir
                    </button>
                @else
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pendaftaran Tugas Akhir</h5>
                        </div>
                        @if ($final_exam->status == 'pending')
                            <div class="card">
                                <div class="card-body alert alert-warning">
                                    <p class="card-text">Pendaftaran Ujian Tugas Akhir belum disetujui, Silahkan tunggu
                                        konfirmasi dari
                                        admin</p>
                                </div>
                            </div>
                        @elseif($final_exam->status == 'rejected')
                            <div class="card">
                                <div class="card-body alert alert-danger">
                                    <p class="card-text">Pendaftaran Ujian Tugas Akhir ditolak, Silahkan cek kembali data
                                        yang
                                        dimasukkan, dan lalukan pendaftaran kembali</p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#pengajuan">
                                        Pendaftaran Ujian Tugas Akhir
                                    </button>
                                </div>
                            </div>
                        @elseif ($final_exam->status == 'approved')
                            <div class="card">
                                @if ($final_exam->status_kelulusan == 'pending')
                                    <div class="card-body alert alert-success">
                                        <p class="card-text">Pendaftaran Ujian Tugas Akhir telah disetujui, Silahkan
                                            menunggu jadwal ujian
                                            dari admin</p>
                                    </div>
                                @elseif ($final_exam->status_kelulusan == 'lulus')
                                    <div class="card-body alert alert-success">
                                        <p class="card-text">Anda Dinyatakan <span class="badge bg-success"
                                                style="font-size: 1.3rem ">Lulus</span>, Silahkan Lanjutkan ke Tahap
                                            Pengisian Dokumen FInal </p>
                                    </div>
                                @elseif ($final_exam->status_kelulusan == 'tidak lulus')
                                    <div class="card-body alert alert-danger">
                                        <p class="card-text">Anda Dinyatakan <span class="badge bg-danger">Tidak
                                                Lulus</span>, Silahkan cek jadwal ujian dibawah ini</p>
                                    </div>
                                @endif
                                @if ($jadwal_exam)
                                    <div class="card mb-3 ">
                                        <div class="card-body">
                                            <h5 class="card-title">Jadwal Ujian Tugas Akhir</h5>
                                            <p class="card-text">Jadwal Ujian Tugas Akhir telah ditentukan, Silahkan cek
                                                jadwal dibawah
                                                ini</p>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>Nama Mahasiswa</td>
                                                    <td>:</td>
                                                    <td>{{ $jadwal_exam->user->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>NIM</td>
                                                    <td>:</td>
                                                    <td>{{ $jadwal_exam->user->nim }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Dosen Pembimbing</td>
                                                    <td>:</td>
                                                    <td>
                                                        <ul>
                                                            <li>{{ $jadwal_exam->finalExam->pembimbing_1 }} - (Dosen
                                                                Pembimbing 1)</li>
                                                            <li>{{ $jadwal_exam->finalExam->pembimbing_2 }} - (Dosen
                                                                Pembimbing 2)</li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Dosen Penguji</td>
                                                    <td>:</td>
                                                    <td>
                                                        <ul>
                                                            <li>{{ $jadwal_exam->finalExam->penguji_1 }} - (Penguji 1)</li>
                                                            <li>{{ $jadwal_exam->finalExam->penguji_2 }} - (Penguji 2)</li>
                                                            <li>{{ $jadwal_exam->finalExam->penguji_3 }} - (Penguji 3)</li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Waktu</td>
                                                    <td>:</td>
                                                    <td> {{ $jadwal_exam->waktu }} ({{ $jadwal_exam->tanggal }})</td>
                                                </tr>
                                                <tr>
                                                    <td>Tempat</td>
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
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>NIM</th>
                                        <th>No HP</th>
                                        <th>Judul</th>
                                        <th>Dosen Pembimbing</th>
                                        <th>Dosen Penguji</th>
                                        <th>Dokumen</th>
                                        <th>Catatan Mahasiswa</th>
                                        <th>Catatan Admin</th>
                                        <th>Status</th>
                                        <th>Tanggal Pengajuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($final_exams as $final_exam)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $final_exam->user->name }}</td>
                                            <td>{{ $final_exam->user->nim }}</td>
                                            <td>{{ $final_exam->user->telephone }}</td>
                                            <td>{{ $final_exam->judul }}</td>
                                            <td>
                                                <ul>
                                                    <li>{{ $final_exam->pembimbing_1 }} - (Dosen Pembimbing 1)</li>
                                                    <li>{{ $final_exam->pembimbing_2 }} - (Dosen Pembimbing 2)</li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>{{ $final_exam->penguji_1 }} - (Penguji 1)</li>
                                                    <li>{{ $final_exam->penguji_2 }} - (Penguji 2)</li>
                                                    <li>{{ $final_exam->penguji_3 }} - (Penguji 3)</li>
                                                </ul>
                                            </td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#dokumen{{ $final_exam->id }}">
                                                    Dokumen
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="dokumen{{ $final_exam->id }}" tabindex="-1"
                                                    aria-labelledby="dokumenLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="dokumenLabel">Dokumen</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <td>File Skripsi</td>
                                                                        <td>:</td>
                                                                        <td><a href="{{ asset('storage/final_exam/' . $final_exam->file_1) }}"
                                                                                target="_blank">File Skripsi</a></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Surat Keterangan Persetujuan Tugas Akhir</td>
                                                                        <td>:</td>
                                                                        <td><a href="{{ asset('storage/final_exam/' . $final_exam->file_2) }}"
                                                                                target="_blank">Surat Keterangan Persetujuan
                                                                                Tugas Akhir</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Kartu Kehadiran Ujian Proposal Tugas Akhir</td>
                                                                        <td>:</td>
                                                                        <td><a href="{{ asset('storage/final_exam/' . $final_exam->file_3) }}"
                                                                                target="_blank">Kartu Kehadiran Ujian
                                                                                Proposal Tugas
                                                                                Akhir</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Logbook Kegiatan Tugas Akhir</td>
                                                                        <td>:</td>
                                                                        <td><a href="{{ asset('storage/final_exam/' . $final_exam->file_4) }}"
                                                                                target="_blank">Logbook Kegiatan Tugas
                                                                                Akhir</a>
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
                                            <td>{{ $final_exam->catatan_mahasiswa ?? '-' }}</td>
                                            <td>{{ $final_exam->catatan_admin ?? '-' }}</td>
                                            <td>
                                                @if ($final_exam->status == 'approved')
                                                    <span class="badge bg-success">Disetujui</span>
                                                @elseif ($final_exam->status == 'rejected')
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @else
                                                    <span class="badge bg-warning">Pending</span>
                                                @endif
                                            </td>
                                            <td>{{ $final_exam->created_at->format('d-m-Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
                <br>
            </div>
        </div>



        <div class="modal fade" id="pengajuan" tabindex="-1" aria-labelledby="pengajuanLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('user.examPost') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="pengajuanLabel">Pendaftaran Ujian Tugas Akhir</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            <div class="form-group mb-3">
                                <label for="catatan_mahasiswa">Catatan Mahasiswa</label>
                                <textarea name="catatan_mahasiswa" id="catatan_mahasiswa" class="form-control"></textarea>
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
    @endif
@endsection
