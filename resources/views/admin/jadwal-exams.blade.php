@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Pengaturan Jadwal Ujian Tugas Akhir</h5>

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
                                    <th>No HP</th>
                                    <th>Judul</th>
                                    <th>Dosen Pembimbing</th>
                                    <th>Dosen Penguji</th>
                                    <th>Dokumen</th>
                                    <th>Status</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($belumTerjadwal as $proposal)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $proposal->user->name }}</td>
                                        <td>{{ $proposal->user->nim }}</td>
                                        <td>{{ $proposal->user->telephone }}</td>
                                        <td>{{ $proposal->judul }}</td>
                                        <td>
                                            <ul>
                                                <li>{{ $proposal->pembimbing_1 }} (Pembimbing 1)</li>
                                                <li>{{ $proposal->pembimbing_2 }} (Pembimbing 2)</li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li>{{ $proposal->penguji_1 }} (Penguji 1)</li>
                                                <li>{{ $proposal->penguji_2 }} (Penguji 2)</li>
                                                <li>{{ $proposal->penguji_3 }} (Penguji 3)</li>
                                            </ul>
                                        </td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#detailDokumen{{ $proposal->id }}">
                                                Dokumen
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="detailDokumen{{ $proposal->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Detail Proposal
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-bordered">
                                                                <tr>
                                                                    <td>Dokumen Skripsi</td>
                                                                    <td>:</td>
                                                                    <td><a target="_blank" class="btn btn-outline-primary"
                                                                            href="{{ asset('storage/final_exam/' . $proposal->file_1) }}">Download</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Surat Keterangan Persetujuan Tugas Akhir</td>
                                                                    <td>:</td>
                                                                    <td><a target="_blank" class="btn btn-outline-primary"
                                                                            href="{{ asset('storage/final_exam/' . $proposal->file_2) }}">Download</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Kartu Kehadiran Ujian Proposal Tugas Akhir</td>
                                                                    <td>:</td>
                                                                    <td><a target="_blank" class="btn btn-outline-primary"
                                                                            href="{{ asset('storage/final_exam/' . $proposal->file_3) }}">Download</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Logbook Kegiatan Tugas Akhir</td>
                                                                    <td>:</td>
                                                                    <td><a target="_blank" class="btn btn-outline-primary"
                                                                            href="{{ asset('storage/final_exam/' . $proposal->file_4) }}">Download</a>
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
                                                        <form action="{{ route('admin.jadwal.exams.store') }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Form
                                                                    Pembuatan Jadwal</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <input type="hidden" name="final_exam_id"
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
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable1" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>NIM</th>
                                    <th>No HP</th>
                                    <th>Judul</th>
                                    <th>Waktu</th>
                                    <th>Tempat</th>
                                    <th>Dosen</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwal as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->user->nim }}</td>
                                        <td>{{ $item->user->telephone }}</td>
                                        <td>{{ $item->finalExam->judul }}</td>
                                        <td>{{ $item->waktu }} - {{ $item->tanggal }}</td>
                                        <td>{{ $item->tempat }}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                                data-bs-target="#updateDosen{{ $item->id }}">
                                                Update Dosen
                                            </button>
                                            <div class="modal fade" id="updateDosen{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('admin.final-exam.updateDosen') }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Update
                                                                    Dosen Penguji
                                                                    {{ $item->user->name }}</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="final_exam_id"
                                                                        value="{{ $item->finalExam->id }}">
                                                                    <div class="form-group mb-3">
                                                                        <label for="pembimbing_1">Dosen Pembimbing 1 <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text" name="pembimbing_1"
                                                                            class="form-control" required
                                                                            value="{{ $item->finalExam->pembimbing_1 }}">
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="pembimbing_2">Dosen Pembimbing 2 <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text" name="pembimbing_2"
                                                                            class="form-control" required
                                                                            value="{{ $item->finalExam->pembimbing_2 }}">
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="penguji_1">Dosen Penguji 1 <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text" name="penguji_1"
                                                                            class="form-control" required
                                                                            value="{{ $item->finalExam->penguji_1 }}">
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="penguji_2">Dosen Penguji 2 <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text" name="penguji_2"
                                                                            class="form-control" required
                                                                            value="{{ $item->finalExam->penguji_2 }}">
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="penguji_3">Dosen Penguji 3 <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text" name="penguji_3"
                                                                            class="form-control" required
                                                                            value="{{ $item->finalExam->penguji_3 }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $item->id }}">
                                                Detail
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Jadwal Ujian
                                                                Tugas Akhir
                                                                {{ $item->user->name }}</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-bordered">
                                                                <tr>
                                                                    <th>Nama Mahasiswa</th>
                                                                    <td>:</td>
                                                                    <td>{{ $item->user->name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>NIM</th>
                                                                    <td>:</td>
                                                                    <td>{{ $item->user->nim }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Judul</th>
                                                                    <td>:</td>
                                                                    <td>{{ $item->finalExam->judul }}</td>
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
                                                                    <td>{{ $item->finalExam->pembimbing_1 }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Dosen Pembimbing 2</th>
                                                                    <td>:</td>
                                                                    <td>{{ $item->finalExam->pembimbing_2 }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Dosen Penguji 1</th>
                                                                    <td>:</td>
                                                                    <td>{{ $item->finalExam->penguji_1 }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Dosen Penguji 2</th>
                                                                    <td>:</td>
                                                                    <td>{{ $item->finalExam->penguji_2 }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Dosen Penguji 3</th>
                                                                    <td>:</td>
                                                                    <td>{{ $item->finalExam->penguji_3 }}</td>
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
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#update{{ $item->id }}">
                                                Update
                                            </button>
                                            <div class="modal fade" id="update{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('admin.jadwal.exams.update') }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Update
                                                                    Jadwal Ujian Tugas Akhir
                                                                    {{ $item->user->name }}</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $item->id }}">
                                                                    <div class="form-group mb-3">
                                                                        <label for="tanggal">Tanggal <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="date" name="tanggal"
                                                                            class="form-control" required
                                                                            value="{{ $item->tanggal }}">
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="waktu">Waktu <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text" name="waktu"
                                                                            class="form-control" required
                                                                            value="{{ $item->waktu }}">
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="tempat">Tempat <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text" name="tempat"
                                                                            class="form-control" required
                                                                            value="{{ $item->tempat }}">
                                                                    </div>

                                                                    <div class="form-group mb-3">
                                                                        <label for="keterangan">Keterangan</label>
                                                                        <textarea name="keterangan" class="form-control" rows="3" value="{{ $item->keterangan }}"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </div>
                                                    </form>
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
    </div>
@endsection
