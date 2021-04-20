@extends('layouts.main')

@section('content')
<style>
.set-button{
    font-size: 14px;
    letter-spacing: normal;
    padding: 10px 20px;
    color: #6c757d;
}
</style>
<section class="section">
    <div class="section-header">
        <h1>{{$class->name}} Peserta {{$exam->name}}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">{{$class->name}} Peserta {{$exam->name}}</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>{{$class->name}} Peserta {{$exam->name}}</h4>
                <div class="card-header-action">
                    <a href="{{route('school_admin.exam-scores.exportExam', [$exam->id,$class->id])}}" class="btn btn-success">Export Excel</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NISN</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Nilai</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($class->students()->orderBy('name', 'ASC')->get() as $key => $student)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $student->nisn }}</td>
                                <td>{{ $student->nis }}</td>
                                <td>{{ $student->name }}</td>
                                @php
                                    $examScore = $student->examScores()->where('exam_id', $exam->id)->first();
                                @endphp
                                <td>
                                    {{ $examScore ? \Carbon\Carbon::parse($examScore->time_start)->isoFormat('dddd, DD MMMM  YYYY HH:mm') : '-' }}
                                </td>
                                <td>
                                    {{ $examScore ? \Carbon\Carbon::parse($examScore->time_finish)->isoFormat('dddd, DD MMMM YYYY HH:mm') : '-' }}
                                </td>
                                <td>
                                    {{ $examScore->score ?? 'Belum Mengerjakan' }}
                                </td>
                                <td class="text-center">
                                    <a href="{{route('school_admin.exam-scores.indexScore', $exam->id)}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
