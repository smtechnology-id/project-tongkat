@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Data Dokumen Final</h5>
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($finalDocuments as $finalDocument)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $finalDocument->user->name }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#detail{{ $finalDocument->id }}">
                                    Detail Dokumen Final
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="detail{{ $finalDocument->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
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
                                                        <td>Pas Foto</td>
                                                        <td>:</td>
                                                        <td><a href="{{ asset('storage/final_document/' . $finalDocument->pass_foto) }}"
                                                                target="_blank">Lihat Pas Foto</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>File Tugas Akhir</td>
                                                        <td>:</td>
                                                        <td><a href="{{ asset('storage/final_document/' . $finalDocument->file_tugas_akhir) }}"
                                                                target="_blank">Lihat File Tugas Akhir</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Buku Tugas Akhir</td>
                                                        <td>:</td>
                                                        <td><a href="{{ asset('storage/final_document/' . $finalDocument->buku_tugas_akhir) }}"
                                                                target="_blank">Lihat Buku Tugas Akhir</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Surat Tugas Pembimbing</td>
                                                        <td>:</td>
                                                        <td><a href="{{ asset('storage/final_document/' . $finalDocument->surat_tugas_pembimbing) }}"
                                                                target="_blank">Lihat Surat Tugas Pembimbing</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Surat Tugas Penguji Ujian Proposal</td>
                                                        <td>:</td>
                                                        <td><a href="{{ asset('storage/final_document/' . $finalDocument->surat_tugas_penguji_ujian_proposal) }}"
                                                                target="_blank">Lihat Surat Tugas Penguji Ujian Proposal</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Berita Acara Ujian Proposal</td>
                                                        <td>:</td>
                                                        <td><a href="{{ asset('storage/final_document/' . $finalDocument->berita_acara_ujian_proposal) }}"
                                                                target="_blank">Lihat Berita Acara Ujian Proposal</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Surat Tugas Penguji Tugas Akhir</td>
                                                        <td>:</td>
                                                        <td><a href="{{ asset('storage/final_document/' . $finalDocument->surat_tugas_penguji_tugas_akhir) }}"
                                                                target="_blank">Lihat Surat Tugas Penguji Tugas Akhir</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Logbook Final Tugas Akhir</td>
                                                        <td>:</td>
                                                        <td><a href="{{ asset('storage/final_document/' . $finalDocument->logbook_final_tugas_akhir) }}"
                                                                target="_blank">Lihat Logbook Final Tugas Akhir</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kartu Kehadiran Peserta Seminar Proposal</td>
                                                        <td>:</td>
                                                        <td><a href="{{ asset('storage/final_document/' . $finalDocument->kartu_kehadiran_peserta_seminar_proposal) }}"
                                                                target="_blank">Lihat Kartu Kehadiran Peserta Seminar Proposal</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Surat Keterangan Persetujuan Ujian Tugas Akhir</td>
                                                        <td>:</td>
                                                        <td><a href="{{ asset('storage/final_document/' . $finalDocument->surat_keterangan_persetujuan_ujian_tugas_akhir) }}"
                                                                target="_blank">Lihat Surat Keterangan Persetujuan Ujian Tugas Akhir</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Berita Acara Ujian Tugas Akhir</td>
                                                        <td>:</td>
                                                        <td><a href="{{ asset('storage/final_document/' . $finalDocument->berita_acara_ujian_tugas_akhir) }}"
                                                                target="_blank">Lihat Berita Acara Ujian Tugas Akhir</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>TOEFL</td>
                                                        <td>:</td>
                                                        <td><a href="{{ asset('storage/final_document/' . $finalDocument->toefl) }}"
                                                                target="_blank">Lihat TOEFL</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Letter of Acceptance</td>
                                                        <td>:</td>
                                                        <td><a href="{{ asset('storage/final_document/' . $finalDocument->letter_of_acceptance) }}"
                                                                target="_blank">Lihat Letter of Acceptance</a></td>
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
