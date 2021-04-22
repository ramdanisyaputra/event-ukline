@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Nilai Ujian</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('school_admin.index') }}">Beranda</a></div>
            <div class="breadcrumb-item">Daftar Ujian</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Ujian</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Ujian</th>
                                <th>Tanggal</th>
                                <th>Durasi</th>
                                <th>Matapelajaran</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($examClass as $key => $examKelas)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $examKelas->exam->name }} <span class="badge badge-light p-1 ml-1">{{ ucwords($examKelas->exam->shared ? 'Serentak' : 'Mandiri') }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($examKelas->exam->started_at)->isoFormat('dddd, DD MMMM Y') }}</td>
                                <td>{{ $examKelas->exam->duration }} menit</td>
                                <td>{{ $examKelas->subject->name }}</td>
                                <td class="text-center">
                                    <a href="{{route('school_admin.exam-scores.indexScore', $examKelas->exam_id)}}" class="btn btn-success">Pilih Ujian</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data</td>
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