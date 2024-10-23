@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Pengaturan Jadwal Seminar Proposal</h5>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('admin.jadwal.proposal') }}">Jadwal Seminar Proposal</a></h5>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><a href="">Jadwal Seminar Ujian Skripsi</a></h5>
                </div>
            </div>
        </div>
    </div>
@endsection
