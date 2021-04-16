@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pratinjau Soal</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('school_admin.index') }}">Beranda</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('school_admin.exams.index') }}">Kumpulan Ujian</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('school_admin.exams.questions.index', $exam->id) }}">{{ $exam->name }}</a></div>
            <div class="breadcrumb-item">Pratinjau</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Pratinjau Soal {{ $exam->name }} </h4>
            </div>
            <div class="card-body">
                <div>
                    <table>
                        <tr>
                            <td>Judul Ujian</td>
                            <td class="px-2">:</td>
                            <td>{{$exam->name}}</td>
                        </tr>
                        <tr>
                            <td>Jenis Ujian</td>
                            <td class="px-2">:</td>
                            <td>{{$exam->examType->name}}</td>
                        </tr>
                        <tr>
                            <td>Durasi Ujian</td>
                            <td class="px-2">:</td>
                            <td>{{$exam->duration}} Menit</td>
                        </tr>
                        <tr>
                            <td>Tanggal Pelaksanaan</td>
                            <td class="px-2">:</td>
                            <td>{{ \Carbon\Carbon::parse($exam->started_at)->isoFormat('dddd, DD MMMM YYYY') }}</td>
                        </tr>
                    </table>
                    <hr>
                    <div class="mt-3">
                        <ol class="pl-4">
                        @foreach($examQuestions as $examQuestion)
                            <li class="pb-3">
                                <div class="ml-2">
                                    {!! $examQuestion->question !!}
                                </div>
                                @if($examQuestion->question_type == 'PG')
                                <ol type="a" class="pl-3">
                                    @foreach (json_decode($examQuestion->option) as $key => $option)
                                    <li class="{{ $key == $examQuestion->answer ? 'text-primary font-weight-bold' : '' }}">{!! $option !!}</li>
                                    @endforeach
                                </ol>
                                @endif
                            </li>
                        @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection