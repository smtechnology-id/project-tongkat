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
                                            <img src="{{ asset('storage/final_document/' . $final_documents->pass_foto) }}"
                                                alt="Pass Foto" style="width: 100%; height: 100%; object-fit: cover;">
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
                                                    <td>Surat tugas pembimbing</td>
                                                </tr>
                                                <tr>
                                                    <td>✅</td>
                                                    <td>Surat tugas penguji ujian proposal</td>
                                                </tr>
                                                <tr>
                                                    <td>✅</td>
                                                    <td>Berita acara ujian proposal</td>
                                                </tr>
                                                <tr>
                                                    <td>✅</td>
                                                    <td>Surat tugas penguji ujian tugas akhir</td>
                                                </tr>
                                                <tr>
                                                    <td>✅</td>
                                                    <td>Logbook Final Tugas Akhir</td>
                                                </tr>
                                                <tr>
                                                    <td>✅</td>
                                                    <td>Kartu kehadiran peserta seminar proposal</td>
                                                </tr>
                                                <tr>
                                                    <td>✅</td>
                                                    <td>Surat keterangan persetujuan ujian tugas akhir</td>
                                                </tr>
                                                <tr>
                                                    <td>✅</td>
                                                    <td>Berita acara ujian tugas akhir</td>
                                                </tr>
                                                <tr>
                                                    <td>✅</td>
                                                    <td>TOEFL</td>
                                                </tr>
                                                <tr>
                                                    <td>✅</td>
                                                    <td>Letter of Acceptance</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#update">
                            Update Dokumen Final
                        </button>
                        <div class="modal fade" id="update" tabindex="-1" aria-labelledby="update"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="update">Update Dokumen Final</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('user.final-document.update') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="pass_foto" class="form-label">Pas Foto</label>
                                                <input type="file" class="form-control" id="pass_foto" name="pass_foto"
                                                     accept="image/*" >
                                                     <a href="{{ asset('storage/final_document/' . $final_documents->pass_foto) }}" target="_blank">Lihat Pas Foto</a>
                                            </div>

                                            <div class="mb-3">
                                                <label for="buku_tugas_akhir" class="form-label">Buku Tugas Akhir</label>
                                                <input type="file" class="form-control" id="buku_tugas_akhir"
                                                    name="buku_tugas_akhir" accept="application/pdf">
                                                    <a href="{{ asset('storage/final_document/' . $final_documents->buku_tugas_akhir) }}" target="_blank">Lihat Buku Tugas Akhir</a>
                                            </div>

                                            <div class="mb-3">
                                                <label for="surat_tugas_pembimbing" class="form-label">Surat Tugas
                                                    Pembimbing</label>
                                                <input type="file" class="form-control" id="surat_tugas_pembimbing"
                                                    name="surat_tugas_pembimbing" accept="application/pdf">
                                                    <a href="{{ asset('storage/final_document/' . $final_documents->surat_tugas_pembimbing) }}" target="_blank">Lihat Surat Tugas Pembimbing</a>
                                            </div>

                                            <div class="mb-3">
                                                <label for="surat_tugas_penguji_ujian_proposal" class="form-label">Surat
                                                    Tugas Penguji Ujian Proposal</label>
                                                <input type="file" class="form-control"
                                                    id="surat_tugas_penguji_ujian_proposal"
                                                    name="surat_tugas_penguji_ujian_proposal" accept="application/pdf">
                                                    <a href="{{ asset('storage/final_document/' . $final_documents->surat_tugas_penguji_ujian_proposal) }}" target="_blank">Lihat Surat Tugas Penguji Ujian Proposal</a>
                                            </div>

                                            <div class="mb-3">
                                                <label for="berita_acara_ujian_proposal" class="form-label">Berita Acara
                                                    Ujian Proposal</label>
                                                <input type="file" class="form-control" id="berita_acara_ujian_proposal"
                                                    name="berita_acara_ujian_proposal" accept="application/pdf">
                                                    <a href="{{ asset('storage/final_document/' . $final_documents->berita_acara_ujian_proposal) }}" target="_blank">Lihat Berita Acara Ujian Proposal</a>
                                            </div>

                                            <div class="mb-3">
                                                <label for="surat_tugas_penguji_tugas_akhir" class="form-label">Surat Tugas
                                                    Penguji Tugas Akhir</label>
                                                <input type="file" class="form-control"
                                                    id="surat_tugas_penguji_tugas_akhir"
                                                    name="surat_tugas_penguji_tugas_akhir" accept="application/pdf">
                                                    <a href="{{ asset('storage/final_document/' . $final_documents->surat_tugas_penguji_tugas_akhir) }}" target="_blank">Lihat Surat Tugas Penguji Tugas Akhir</a>
                                            </div>

                                            <div class="mb-3">
                                                <label for="logbook_final_tugas_akhir" class="form-label">Logbook Final
                                                    Tugas Akhir</label>
                                                <input type="file" class="form-control" id="logbook_final_tugas_akhir"
                                                    name="logbook_final_tugas_akhir" accept="application/pdf">
                                                    <a href="{{ asset('storage/final_document/' . $final_documents->logbook_final_tugas_akhir) }}" target="_blank">Lihat Logbook Final Tugas Akhir</a>
                                            </div>

                                            <div class="mb-3">
                                                <label for="kartu_kehadiran_peserta_seminar_proposal"
                                                    class="form-label">Kartu Kehadiran Peserta Seminar Proposal</label>
                                                <input type="file" class="form-control"
                                                    id="kartu_kehadiran_peserta_seminar_proposal"
                                                    name="kartu_kehadiran_peserta_seminar_proposal" accept="application/pdf">
                                                    <a href="{{ asset('storage/final_document/' . $final_documents->kartu_kehadiran_peserta_seminar_proposal) }}" target="_blank">Lihat Kartu Kehadiran Peserta Seminar Proposal</a>
                                            </div>

                                            <div class="mb-3">
                                                <label for="surat_keterangan_persetujuan_ujian_tugas_akhir"
                                                    class="form-label">Surat Keterangan Persetujuan Ujian Tugas
                                                    Akhir</label>
                                                <input type="file" class="form-control"
                                                    id="surat_keterangan_persetujuan_ujian_tugas_akhir"
                                                    name="surat_keterangan_persetujuan_ujian_tugas_akhir" accept="application/pdf">
                                                    <a href="{{ asset('storage/final_document/' . $final_documents->surat_keterangan_persetujuan_ujian_tugas_akhir) }}" target="_blank">Lihat Surat Keterangan Persetujuan Ujian Tugas Akhir</a>
                                            </div>

                                            <div class="mb-3">
                                                <label for="berita_acara_ujian_tugas_akhir" class="form-label">Berita
                                                    Acara Ujian Tugas Akhir</label>
                                                <input type="file" class="form-control"
                                                    id="berita_acara_ujian_tugas_akhir"
                                                    name="berita_acara_ujian_tugas_akhir" accept="application/pdf">
                                                    <a href="{{ asset('storage/final_document/' . $final_documents->berita_acara_ujian_tugas_akhir) }}" target="_blank">Lihat Berita Acara Ujian Tugas Akhir</a>
                                            </div>

                                            <div class="mb-3">
                                                <label for="toefl" class="form-label">TOEFL</label>
                                                <input type="file" class="form-control" id="toefl" name="toefl"
                                                    accept="application/pdf">
                                                    <a href="{{ asset('storage/final_document/' . $final_documents->toefl) }}" target="_blank">Lihat TOEFL</a>
                                            </div>

                                            <div class="mb-3">
                                                <label for="letter_of_acceptance" class="form-label">Letter of
                                                    Acceptance</label>
                                                <input type="file" class="form-control" id="letter_of_acceptance"
                                                    name="letter_of_acceptance" accept="application/pdf">
                                                    <a href="{{ asset('storage/final_document/' . $final_documents->letter_of_acceptance) }}" target="_blank">Lihat Letter of Acceptance</a>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <tr>
                                <td>Pas Foto</td>
                                <td>:</td>
                                <td><a href="{{ asset('storage/final_document/' . $final_documents->pass_foto) }}"
                                        target="_blank">Lihat Pas Foto</a></td>
                            </tr>
                            <tr>
                                <td>Buku Tugas Akhir</td>
                                <td>:</td>
                                <td><a href="{{ asset('storage/final_document/' . $final_documents->buku_tugas_akhir) }}"
                                        target="_blank">Lihat Buku Tugas Akhir</a></td>
                            </tr>
                            <tr>
                                <td>Surat Tugas Pembimbing</td>
                                <td>:</td>
                                <td><a href="{{ asset('storage/final_document/' . $final_documents->surat_tugas_pembimbing) }}"
                                        target="_blank">Lihat Surat Tugas Pembimbing</a></td>
                            </tr>
                            <tr>
                                <td>Surat Tugas Penguji Ujian Proposal</td>
                                <td>:</td>
                                <td><a href="{{ asset('storage/final_document/' . $final_documents->surat_tugas_penguji_ujian_proposal) }}"
                                        target="_blank">Lihat Surat Tugas Penguji Ujian Proposal</a></td>
                            </tr>
                            <tr>
                                <td>Berita Acara Ujian Proposal</td>
                                <td>:</td>
                                <td><a href="{{ asset('storage/final_document/' . $final_documents->berita_acara_ujian_proposal) }}"
                                        target="_blank">Lihat Berita Acara Ujian Proposal</a></td>
                            </tr>
                            <tr>
                                <td>Surat Tugas Penguji Tugas Akhir</td>
                                <td>:</td>
                                <td><a href="{{ asset('storage/final_document/' . $final_documents->surat_tugas_penguji_tugas_akhir) }}"
                                        target="_blank">Lihat Surat Tugas Penguji Tugas Akhir</a></td>
                            </tr>
                            <tr>
                                <td>Logbook Final Tugas Akhir</td>
                                <td>:</td>
                                <td><a href="{{ asset('storage/final_document/' . $final_documents->logbook_final_tugas_akhir) }}"
                                        target="_blank">Lihat Logbook Final Tugas Akhir</a></td>
                            </tr>
                            <tr>
                                <td>Kartu Kehadiran Peserta Seminar Proposal</td>
                                <td>:</td>
                                <td><a href="{{ asset('storage/final_document/' . $final_documents->kartu_kehadiran_peserta_seminar_proposal) }}"
                                        target="_blank">Lihat Kartu Kehadiran Peserta Seminar Proposal</a></td>
                            </tr>
                            <tr>
                                <td>Surat Keterangan Persetujuan Ujian Tugas Akhir</td>
                                <td>:</td>
                                <td><a href="{{ asset('storage/final_document/' . $final_documents->surat_keterangan_persetujuan_ujian_tugas_akhir) }}"
                                        target="_blank">Lihat Surat Keterangan Persetujuan Ujian Tugas Akhir</a></td>
                            </tr>
                            <tr>
                                <td>Berita Acara Ujian Tugas Akhir</td>
                                <td>:</td>
                                <td><a href="{{ asset('storage/final_document/' . $final_documents->berita_acara_ujian_tugas_akhir) }}"
                                        target="_blank">Lihat Berita Acara Ujian Tugas Akhir</a></td>
                            </tr>
                            <tr>
                                <td>TOEFL</td>
                                <td>:</td>
                                <td><a href="{{ asset('storage/final_document/' . $final_documents->toefl) }}"
                                        target="_blank">Lihat TOEFL</a></td>
                            </tr>
                            <tr>
                                <td>Letter of Acceptance</td>
                                <td>:</td>
                                <td><a href="{{ asset('storage/final_document/' . $final_documents->letter_of_acceptance) }}"
                                        target="_blank">Lihat Letter of Acceptance</a></td>
                            </tr>
                        </table>
                    @else
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Upload Dokumen Final
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Upload Dokumen Final</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('user.final-document.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="mb-3">
                                                <label for="pass_foto" class="form-label">Pas Foto</label>
                                                <input type="file" class="form-control" id="pass_foto"
                                                    name="pass_foto" required accept="image/*">
                                            </div>

                                            <div class="mb-3">
                                                <label for="buku_tugas_akhir" class="form-label">Buku Tugas Akhir</label>
                                                <input type="file" class="form-control" id="buku_tugas_akhir"
                                                    name="buku_tugas_akhir" required accept="application/pdf">
                                            </div>

                                            <div class="mb-3">
                                                <label for="surat_tugas_pembimbing" class="form-label">Surat Tugas
                                                    Pembimbing</label>
                                                <input type="file" class="form-control" id="surat_tugas_pembimbing"
                                                    name="surat_tugas_pembimbing" required accept="application/pdf">
                                            </div>

                                            <div class="mb-3">
                                                <label for="surat_tugas_penguji_ujian_proposal" class="form-label">Surat
                                                    Tugas Penguji Ujian Proposal</label>
                                                <input type="file" class="form-control"
                                                    id="surat_tugas_penguji_ujian_proposal"
                                                    name="surat_tugas_penguji_ujian_proposal" required
                                                    accept="application/pdf">
                                            </div>

                                            <div class="mb-3">
                                                <label for="berita_acara_ujian_proposal" class="form-label">Berita Acara
                                                    Ujian Proposal</label>
                                                <input type="file" class="form-control"
                                                    id="berita_acara_ujian_proposal" name="berita_acara_ujian_proposal"
                                                    required accept="application/pdf">
                                            </div>

                                            <div class="mb-3">
                                                <label for="surat_tugas_penguji_tugas_akhir" class="form-label">Surat
                                                    Tugas Penguji Tugas Akhir</label>
                                                <input type="file" class="form-control"
                                                    id="surat_tugas_penguji_tugas_akhir"
                                                    name="surat_tugas_penguji_tugas_akhir" required
                                                    accept="application/pdf">
                                            </div>

                                            <div class="mb-3">
                                                <label for="logbook_final_tugas_akhir" class="form-label">Logbook Final
                                                    Tugas Akhir</label>
                                                <input type="file" class="form-control" id="logbook_final_tugas_akhir"
                                                    name="logbook_final_tugas_akhir" required accept="application/pdf">
                                            </div>

                                            <div class="mb-3">
                                                <label for="kartu_kehadiran_peserta_seminar_proposal"
                                                    class="form-label">Kartu Kehadiran Peserta Seminar Proposal</label>
                                                <input type="file" class="form-control"
                                                    id="kartu_kehadiran_peserta_seminar_proposal"
                                                    name="kartu_kehadiran_peserta_seminar_proposal" required
                                                    accept="application/pdf">
                                            </div>

                                            <div class="mb-3">
                                                <label for="surat_keterangan_persetujuan_ujian_tugas_akhir"
                                                    class="form-label">Surat Keterangan Persetujuan Ujian Tugas
                                                    Akhir</label>
                                                <input type="file" class="form-control"
                                                    id="surat_keterangan_persetujuan_ujian_tugas_akhir"
                                                    name="surat_keterangan_persetujuan_ujian_tugas_akhir" required
                                                    accept="application/pdf">
                                            </div>

                                            <div class="mb-3">
                                                <label for="berita_acara_ujian_tugas_akhir" class="form-label">Berita
                                                    Acara Ujian Tugas Akhir</label>
                                                <input type="file" class="form-control"
                                                    id="berita_acara_ujian_tugas_akhir"
                                                    name="berita_acara_ujian_tugas_akhir" required
                                                    accept="application/pdf">
                                            </div>

                                            <div class="mb-3">
                                                <label for="toefl" class="form-label">TOEFL</label>
                                                <input type="file" class="form-control" id="toefl" name="toefl"
                                                    required accept="application/pdf">
                                            </div>

                                            <div class="mb-3">
                                                <label for="letter_of_acceptance" class="form-label">Letter of
                                                    Acceptance</label>
                                                <input type="file" class="form-control" id="letter_of_acceptance"
                                                    name="letter_of_acceptance" required accept="application/pdf">
                                            </div>

                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                       
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
