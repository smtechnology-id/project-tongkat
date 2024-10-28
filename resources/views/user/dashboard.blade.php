@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Dashboard</h1>
                    <h3 class="card-subtitle mb-3">Pedoman Penggunaan Sistem</h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">1. Silahkan lengkapi proposal terlebih dahulu, Sampai status proposal
                            menjadi <strong>Lulus</strong></li>
                        <li class="list-group-item">2. Setelah proposal lulus, silahkan lengkapi ujian tugas akhir, Sampai
                            status ujian tugas akhir menjadi <strong>Lulus</strong></li>
                        <li class="list-group-item">3. Setelah ujian tugas akhir lulus, silahkan lengkapi dokumen final</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Dokumen Download</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">1. <a
                                href="{{ asset('assets/dokumen-download/Kartu Kehadiran Ujian Proposal.pdf') }}"
                                target="_blank">Kartu Kehadiran Ujian Proposal</a></li>
                        <li class="list-group-item">2. <a
                                href="{{ asset('assets/dokumen-download/Log Book Tugas Akhir.pdf') }}" target="_blank">Log
                                Book Tugas Akhir</a></li>
                        <li class="list-group-item">3. <a
                                href="{{ asset('assets/dokumen-download/Pedoman TA PSSTL 2021.pdf') }}"
                                target="_blank">Pedoman TA PSSTL 2021</a></li>
                        <li class="list-group-item">4. <a
                                href="{{ asset('assets/dokumen-download/Seminar Proposal Formulir.pdf') }}"
                                target="_blank">Seminar Proposal Formulir</a></li>
                        <li class="list-group-item">5. <a
                                href="{{ asset('assets/dokumen-download/Surat Keterangan Maju Ujian Proposal.docx.pdf') }}"
                                target="_blank">Surat Keterangan Maju Ujian Proposal</a></li>
                        <li class="list-group-item">6. <a
                                href="{{ asset('assets/dokumen-download/Surat Keterangan Maju Ujian Tugas Akhir.pdf') }}"
                                target="_blank">Surat Keterangan Maju Ujian Tugas Akhir</a></li>
                        <li class="list-group-item">7. <a
                                href="{{ asset('assets/dokumen-download/Tugas Akhir formulir.pdf') }}" target="_blank">Tugas
                                Akhir formulir</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
