@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Pengajuan Proposal Skripsi</h5>
            <hr>

            <!-- Button trigger modal -->
            @if ($proposals->count() < 1)
                <p class="card-text">Silahkan isi form dibawah ini untuk mengajukan proposal skripsi</p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pengajuan">
                    Pengajuan Proposal
                </button>
            @else
                @if ($proposal->status == 'pending')
                    <div class="card bg-warning">
                        <div class="card-body">
                            <p class="card-text">Proposal anda sedang menunggu konfirmasi dari Pihak Admin / Panitia,
                                Silahkan
                                menunggu Sampai Status Proposal berubah</p>
                            <p class="card-text">Catatan Dari Admin : {{ $proposal->catatan_admin ?? '-' }}</p>
                        </div>
                    </div>
                @elseif ($proposal->status == 'approved')
                    <div class="card bg-primary">
                        <div class="card-body">
                            <p class="card-text">Proposal Anda Telah Disetujui, Silahkan Lanjutkan Ke Tahap Selanjutnya</p>
                            <p class="card-text">Catatan Dari Admin : {{ $proposal->catatan_admin ?? '-' }}</p>
                        </div>
                    </div>
                @elseif ($proposal->status == 'rejected')
                    <div class="card bg-danger">
                        <div class="card-body">
                            <p class="card-text" style="color: white">Proposal anda telah ditolak, Silahkan Ajukan Proposal Kembali</p>
                            <p class="card-text" style="color: white">Catatan Dari Admin : {{ $proposal->catatan_admin ?? '-' }}</p>
                        </div>
                    </div>
                @endif
            @endif

            @if ($proposal->status == 'approved')
                @if ($jadwal == null)
                    <div class="card bg-warning">
                        <div class="card-body">
                            <p class="card-text">Jadwal Seminar Belum Ditentukan, Silahkan Menunggu Jadwal Dari Admin</p>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">Jadwal Seminar Telah Ditentukan, Silahkan Cek Jadwal Dibawah Ini</p>
                            <p class="text-primary fw-bold">Judul Proposal : {{ $jadwal->proposal->judul }}</p>
                            <table class="table table-bordered">
                                <tr>
                                    <td>Nama Mahasiswa</td>
                                    <td>:</td>
                                    <td>{{ $jadwal->user->name }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Dosen Pembimbing</td>
                                    <td>:</td>
                                    <td>{{ $jadwal->proposal->pembimbing1 }} (Dosen Pembimbing 1), {{ $jadwal->proposal->pembimbing2 }} (Dosen Pembimbing 2)</td>
                                </tr>
                                <tr>
                                    <td>Penguji</td>
                                    <td>:</td>
                                    <td>{{ $jadwal->dosen1 }} (Penguji 1), {{ $jadwal->dosen2 }} (Penguji 2), {{ $jadwal->dosen3 }} (Penguji 3)</td>
                                </tr>
                                <tr>
                                    <td>Waktu Seminar</td>
                                    <td>:</td>
                                    <td>{{ $jadwal->waktu }} ({{ $jadwal->tanggal }})</td>
                                </tr>
                                <tr>
                                    <td>Tempat Seminar</td>
                                    <td>:</td>
                                    <td>{{ $jadwal->tempat }}</td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>:</td>
                                    <td>{{ $jadwal->keterangan }}</td>
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
                        <form action="{{ route('user.proposalPost') }}" method="post" enctype="multipart/form-data">
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
                                        placeholder="Masukkan Judul Skripsi">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="dosen_pembimbing1">Dosen Pembimbing 1 <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="dosen_pembimbing1" id="dosen_pembimbing1"
                                        class="form-control" required
                                        placeholder="Masukkan Nama Dosen Pembimbing 1 Lengkap beserta gelar">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="dosen_pembimbing2">Dosen Pembimbing 2 <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="dosen_pembimbing2" id="dosen_pembimbing2"
                                        class="form-control" required
                                        placeholder="Masukkan Nama Dosen Pembimbing 2 Lengkap beserta gelar">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="file">Surat Keterangan Maju Ujian Proposal <span
                                            class="text-danger">*</span></label>
                                    <input type="file" name="file" id="file" class="form-control" required
                                        accept="application/pdf">
                                    <small class="text-muted">File harus berformat PDF dan maksimal 2MB</small>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="catatan_mahasiswa">Catatan</label>
                                    <textarea name="catatan_mahasiswa" id="catatan_mahasiswa" class="form-control" placeholder="Catatan"></textarea>
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

            <hr>
            <h5>Riwayat Pengajuan Proposal</h5>
            <div class="table-responsive">
                <table class="table table-bordered" id="datatable1" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Dosen Pembimbing 1</th>
                            <th>Dosen Pembimbing 2</th>
                            <th>File</th>
                            <th>Catatan</th>
                            <th>Status</th>
                            <th>Tanggal Pengajuan</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proposals as $proposal)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $proposal->judul }}</td>
                                <td>{{ $proposal->pembimbing1 }}</td>
                                <td>{{ $proposal->pembimbing2 }}</td>
                                <td>
                                    <a target="_blank" href="{{ asset('file_proposal/' . $proposal->file) }}"
                                        class="btn btn-primary">Download</a>
                                </td>
                                <td>{{ $proposal->catatan_mahasiswa }}</td>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
