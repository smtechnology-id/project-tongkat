@extends('layouts.app')

@section('title', 'Dokumen Final')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Dokumen Final</h5>
        @if ($final_exam)
        @if ($final_exam->status_kelulusan == 'lulus')
        @if ($final_documents)
        <div class="card">
            <div class="card-body">
                <h3 class="card-title text-center" style="font-weight: bold; font-size: 20px;">Bukti Dokumen
                    Final</h3>
                <div class="row">
                    <div class="col-4">
                        <div class="box-foto">
                            <img src="{{ asset('storage/final_document/' . $final_documents->file_1) }}" alt="Pass Foto" style="width: 100%; height: 100%; object-fit: cover;">
                            <p class="text-center">Pas Foto</p>
                            <p class="text-center">Judul : {{ $final_exam->judul }}</p>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="box-bio">
                            <table>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>{{ Auth::user()->name }}</td>
                                </tr>
                                <tr>
                                    <td>NIM</td>
                                    <td>:</td>
                                    <td>{{ Auth::user()->nim }}</td>
                                </tr>
                                <tr>
                                    <td>Nomor HP</td>
                                    <td>:</td>
                                    <td>{{ Auth::user()->telephone }}</td>
                                </tr>
                            </table>

                            <table>
                                <tr>
                                    <td>✅</td>
                                    <td>Buku Tugas Akhir</td>
                                </tr>
                                <tr>
                                    <td>✅</td>
                                    <td>Buku Tugas Akhir</td>
                                </tr>
                                <tr>
                                    <td>✅</td>
                                    <td>Form Perbaikan/Revisi Ujian Proposal</td>
                                </tr>
                                <tr>
                                    <td>✅</td>
                                    <td>Form Perbaikan/Revisi Ujian Tugas Akhir</td>
                                </tr>
                                <tr>
                                    <td>✅</td>
                                    <td>Surat Tugas Pembimbing</td>
                                </tr>
                                <tr>
                                    <td>✅</td>
                                    <td>Surat Tugas Penguji Ujian Proposal</td>
                                </tr>
                                <tr>
                                    <td>✅</td>
                                    <td>Berita Acara Ujian Proposal</td>
                                </tr>
                                <tr>
                                    <td>✅</td>
                                    <td>Surat Tugas Penguji Tugas Akhir</td>
                                </tr>
                                <tr>
                                    <td>✅</td>
                                    <td>Logbook Final Tugas</td>
                                </tr>
                                <tr>
                                    <td>✅</td>
                                    <td>Kartu Kehadiran Peserta Seminar Proposal</td>
                                </tr>
                                <tr>
                                    <td>✅</td>
                                    <td>Surat Keterangan Persetujuan Ujian Tugas Akhir</td>
                                </tr>
                                <tr>
                                    <td>✅</td>
                                    <td>Berita Acara Ujian Tugas Akhir</td>
                                </tr>
                                <tr>
                                    <td>✅</td>
                                    <td>TOEFL</td>
                                </tr>
                                <tr>
                                    <td>✅</td>
                                    <td>Letter of Acceptance (LOA)</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#update">
            Update Dokumen Final
        </button>
        <div class="modal fade" id="update" tabindex="-1" aria-labelledby="update" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="update">Update Dokumen Final</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.final-document.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="file_1" class="form-label">Pas Foto</label>
                                <input type="file" class="form-control" id="file_1" name="file_1" accept="image/*">
                                <a href="{{ asset('storage/final_document/' . $final_documents->file_1) }}" target="_blank">Lihat Pas Foto</a>
                            </div>
                            <div class="mb-3">
                                <label for="file_2" class="form-label">Buku Tugas Akhir</label>
                                <input type="file" class="form-control" id="file_2" name="file_2" accept="application/pdf">
                                <a href="{{ asset('storage/final_document/' . $final_documents->file_1) }}" target="_blank">Lihat Pas Foto</a>
                            </div>
                            <div class="mb-3">
                                <label for="file_3" class="form-label">Form Perbaikan/Revisi Ujian Proposal</label>
                                <input type="file" class="form-control" id="file_3" name="file_3" accept="application/pdf">
                                <a href="{{ asset('storage/final_document/' . $final_documents->file_1) }}" target="_blank">Lihat Pas Foto</a>
                            </div>
                            <div class="mb-3">
                                <label for="file_4" class="form-label">Form Perbaikan/Revisi Ujian Tugas Akhir</label>
                                <input type="file" class="form-control" id="file_4" name="file_4" accept="application/pdf">
                                <a href="{{ asset('storage/final_document/' . $final_documents->file_1) }}" target="_blank">Lihat Pas Foto</a>
                            </div>
                            <div class="mb-3">
                                <label for="file_5" class="form-label">Surat Tugas Pembimbing</label>
                                <input type="file" class="form-control" id="file_5" name="file_5" accept="application/pdf">
                                <a href="{{ asset('storage/final_document/' . $final_documents->file_1) }}" target="_blank">Lihat Pas Foto</a>
                            </div>
                            <div class="mb-3">
                                <label for="file_6" class="form-label">Surat Tugas Penguji Ujian Proposal</label>
                                <input type="file" class="form-control" id="file_6" name="file_6" accept="application/pdf">
                                <a href="{{ asset('storage/final_document/' . $final_documents->file_1) }}" target="_blank">Lihat Pas Foto</a>
                            </div>
                            <div class="mb-3">
                                <label for="file_7" class="form-label">Berita Acara Ujian Proposal</label>
                                <input type="file" class="form-control" id="file_7" name="file_7" accept="application/pdf">
                                <a href="{{ asset('storage/final_document/' . $final_documents->file_1) }}" target="_blank">Lihat Pas Foto</a>
                            </div>
                            <div class="mb-3">
                                <label for="file_8" class="form-label">Surat Tugas Penguji Tugas Akhir</label>
                                <input type="file" class="form-control" id="file_8" name="file_8" accept="application/pdf">
                                <a href="{{ asset('storage/final_document/' . $final_documents->file_1) }}" target="_blank">Lihat Pas Foto</a>
                            </div>
                            <div class="mb-3">
                                <label for="file_9" class="form-label">Logbook Final Tugas</label>
                                <input type="file" class="form-control" id="file_9" name="file_9" accept="application/pdf">
                                <a href="{{ asset('storage/final_document/' . $final_documents->file_1) }}" target="_blank">Lihat Pas Foto</a>
                            </div>
                            <div class="mb-3">
                                <label for="file_10" class="form-label">Kartu Kehadiran Peserta Seminar Proposal</label>
                                <input type="file" class="form-control" id="file_10" name="file_10" accept="application/pdf">
                                <a href="{{ asset('storage/final_document/' . $final_documents->file_1) }}" target="_blank">Lihat Pas Foto</a>
                            </div>
                            <div class="mb-3">
                                <label for="file_11" class="form-label">Surat Keterangan Persetujuan Ujian Tugas Akhir</label>
                                <input type="file" class="form-control" id="file_11" name="file_11" accept="application/pdf">
                                <a href="{{ asset('storage/final_document/' . $final_documents->file_1) }}" target="_blank">Lihat Pas Foto</a>
                            </div>
                            <div class="mb-3">
                                <label for="file_12" class="form-label">Berita Acara Ujian Tugas Akhir</label>
                                <input type="file" class="form-control" id="file_12" name="file_12" accept="application/pdf">
                                <a href="{{ asset('storage/final_document/' . $final_documents->file_1) }}" target="_blank">Lihat Pas Foto</a>
                            </div>
                            <div class="mb-3">
                                <label for="file_13" class="form-label">TOEFL</label>
                                <input type="file" class="form-control" id="file_13" name="file_13" accept="application/pdf">
                                <a href="{{ asset('storage/final_document/' . $final_documents->file_1) }}" target="_blank">Lihat Pas Foto</a>
                            </div>
                            <div class="mb-3">
                                <label for="file_14" class="form-label">Letter of Acceptance</label>
                                <input type="file" class="form-control" id="file_14" name="file_14" accept="application/pdf">
                                <a href="{{ asset('storage/final_document/' . $final_documents->file_1) }}" target="_blank">Lihat Pas Foto</a>
                            </div>

                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <tr>
                <td>Pas Foto</td>
                <td>:</td>
                <td><a href="{{ asset('storage/final_document/' . $final_documents->file_1) }}" target="_blank">Lihat Pas Foto</a></td>
            </tr>
            <tr>
                <td>Buku Tugas Akhir</td>
                <td>:</td>
                <td><a href="{{ asset('storage/final_document/' . $final_documents->file_2) }}" target="_blank">Lihat Buku Tugas Akhir</a></td>
            </tr>
            <tr>
                <td>Form Perbaikan/Revisi Ujian Proposal</td>
                <td>:</td>
                <td><a href="{{ asset('storage/final_document/' . $final_documents->file_3) }}" target="_blank">Lihat Form Perbaikan/Revisi Ujian Proposal</a></td>
            </tr>
            <tr>
                <td>Form Perbaikan/Revisi Ujian Tugas Akhir</td>
                <td>:</td>
                <td><a href="{{ asset('storage/final_document/' . $final_documents->file_4) }}" target="_blank">Lihat Form Perbaikan/Revisi Ujian Tugas Akhir</a></td>
            </tr>
            <tr>
                <td>Surat Tugas Pembimbing</td>
                <td>:</td>
                <td><a href="{{ asset('storage/final_document/' . $final_documents->file_5) }}" target="_blank">Lihat Surat Tugas Pembimbing</a></td>
            </tr>
            <tr>
                <td>Surat Tugas Penguji Ujian Proposal</td>
                <td>:</td>
                <td><a href="{{ asset('storage/final_document/' . $final_documents->file_6) }}" target="_blank">Lihat Surat Tugas Penguji Ujian Proposal</a></td>
            </tr>
            <tr>
                <td>Berita Acara Ujian Proposal</td>
                <td>:</td>
                <td><a href="{{ asset('storage/final_document/' . $final_documents->file_7) }}" target="_blank">Lihat Berita Acara Ujian Proposal</a></td>
            </tr>
            <tr>
                <td>Surat Tugas Penguji Tugas Akhir</td>
                <td>:</td>
                <td><a href="{{ asset('storage/final_document/' . $final_documents->file_8) }}" target="_blank">Lihat Surat Tugas Penguji Tugas Akhir</a></td>
            </tr>
            <tr>
                <td>Logbook Final Tugas</td>
                <td>:</td>
                <td><a href="{{ asset('storage/final_document/' . $final_documents->file_9) }}" target="_blank">Lihat Logbook Final Tugas</a></td>
            </tr>
            <tr>
                <td>Kartu Kehadiran Peserta Seminar Proposal</td>
                <td>:</td>
                <td><a href="{{ asset('storage/final_document/' . $final_documents->file_10) }}" target="_blank">Lihat Kartu Kehadiran Peserta Seminar Proposal</a></td>
            </tr>
            <tr>
                <td>Surat Keterangan Persetujuan Ujian Tugas Akhir</td>
                <td>:</td>
                <td><a href="{{ asset('storage/final_document/' . $final_documents->file_11) }}" target="_blank">Lihat Surat Keterangan Persetujuan Ujian Tugas Akhir</a></td>
            </tr>
            <tr>
                <td>Berita Acara Ujian Tugas Akhir</td>
                <td>:</td>
                <td><a href="{{ asset('storage/final_document/' . $final_documents->file_12) }}" target="_blank">Lihat Berita Acara Ujian Tugas Akhir</a></td>
            </tr>
            <tr>
                <td>TOEFL</td>
                <td>:</td>
                <td><a href="{{ asset('storage/final_document/' . $final_documents->file_13) }}" target="_blank">Lihat TOEFL</a></td>
            </tr>
            <tr>
                <td>Letter of Acceptance</td>
                <td>:</td>
                <td><a href="{{ asset('storage/final_document/' . $final_documents->file_14) }}" target="_blank">Lihat Letter of Acceptance</a></td>
            </tr>

        </table>
        @else
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Upload Dokumen Final
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload Dokumen Final</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.final-document.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="file_1" class="form-label">Pas Foto</label>
                                <input type="file" class="form-control" id="file_1" name="file_1" required accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="file_2" class="form-label">Buku Tugas Akhir</label>
                                <input type="file" class="form-control" id="file_2" name="file_2" required accept="application/pdf">
                            </div>
                            <div class="mb-3">
                                <label for="file_3" class="form-label">Form Perbaikan/Revisi Ujian Proposal</label>
                                <input type="file" class="form-control" id="file_3" name="file_3" required accept="application/pdf">
                            </div>
                            <div class="mb-3">
                                <label for="file_4" class="form-label">Form Perbaikan/Revisi Ujian Tugas Akhir</label>
                                <input type="file" class="form-control" id="file_4" name="file_4" required accept="application/pdf">
                            </div>
                            <div class="mb-3">
                                <label for="file_5" class="form-label">Surat Tugas Pembimbing</label>
                                <input type="file" class="form-control" id="file_5" name="file_5" required accept="application/pdf">
                            </div>
                            <div class="mb-3">
                                <label for="file_6" class="form-label">Surat Tugas Penguji Ujian Proposal</label>
                                <input type="file" class="form-control" id="file_6" name="file_6" required accept="application/pdf">
                            </div>
                            <div class="mb-3">
                                <label for="file_7" class="form-label">Berita Acara Ujian Proposal</label>
                                <input type="file" class="form-control" id="file_7" name="file_7" required accept="application/pdf">
                            </div>
                            <div class="mb-3">
                                <label for="file_8" class="form-label">Surat Tugas Penguji Tugas Akhir</label>
                                <input type="file" class="form-control" id="file_8" name="file_8" required accept="application/pdf">
                            </div>
                            <div class="mb-3">
                                <label for="file_9" class="form-label">Logbook Final Tugas</label>
                                <input type="file" class="form-control" id="file_9" name="file_9" required accept="application/pdf">
                            </div>
                            <div class="mb-3">
                                <label for="file_10" class="form-label">Kartu Kehadiran Peserta Seminar Proposal</label>
                                <input type="file" class="form-control" id="file_10" name="file_10" required accept="application/pdf">
                            </div>
                            <div class="mb-3">
                                <label for="file_11" class="form-label">Surat Keterangan Persetujuan Ujian Tugas Akhir</label>
                                <input type="file" class="form-control" id="file_11" name="file_11" required accept="application/pdf">
                            </div>
                            <div class="mb-3">
                                <label for="file_12" class="form-label">Berita Acara Ujian Tugas Akhir</label>
                                <input type="file" class="form-control" id="file_12" name="file_12" required accept="application/pdf">
                            </div>
                            <div class="mb-3">
                                <label for="file_13" class="form-label">TOEFL</label>
                                <input type="file" class="form-control" id="file_13" name="file_13" required accept="application/pdf">
                            </div>
                            <div class="mb-3">
                                <label for="file_14" class="form-label">Letter of Acceptance</label>
                                <input type="file" class="form-control" id="file_14" name="file_14" required accept="application/pdf">
                            </div>

                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
        @endif
        @else
        <div class="alert alert-success" role="alert">
            Anda Tidak Dapat Mengunggah Dokumen Final karena Belum Lulus Ujian Tugas Akhir
        </div>
        @endif
        @else
        <div class="alert alert-danger" role="alert">
            Anda Tidak Dapat Mengunggah Dokumen Final karena Belum Lulus Ujian Tugas Akhir
        </div>
        @endif
    </div>
</div>
@endsection
