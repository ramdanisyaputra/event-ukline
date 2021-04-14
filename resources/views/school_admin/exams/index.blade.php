@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Kumpulan Ujian</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('school_admin.index') }}">Beranda</a></div>
            <div class="breadcrumb-item">Kumpulan Ujian</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Ujian</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary">Tambah</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Dimulai Pada</th>
                                <th>Berakhir Pada</th>
                                <th>Durasi</th>
                                <th>Status</th>
                                <th>Mata Pelajaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($exams as $key => $exam)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $exam->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($exam->started_at)->format('H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($exam->expired_at)->format('H:i') }}</td>
                                <td>{{ $exam->duration }} menit</td>
                                <td><span class="badge badge-primary">{{ ucwords($exam->status) }}</span></td>
                                <td>{{ $exam->examClass ?? 'tes' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td ></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection