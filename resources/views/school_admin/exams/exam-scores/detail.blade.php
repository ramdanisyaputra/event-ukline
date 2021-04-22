@extends('layouts.main')

@section('content')
<style>
    .question p:last-child {
        margin-bottom: 10px;
    }

    .option-list, .question-list {
        padding-left: 20px;
        margin-top: 15px;
    }

    .option-list {
        margin-top: 0px;
    }

    .option-item, .question-item {
        padding-left: 10px;
    }

    .option-item.correct {
        color: #47c363;
        font-weight: 900 !important;
    }

    .option-item.wrong {
        color: #fc544b;
        font-weight: 900 !important;
    }

    .preview-detail td {
        vertical-align: top;
    }

    .preview-detail td:first-child {
        width: 120px;
    }
</style>
<section class="section">
    <div class="section-header">
        <h1>Detail Pengerjaan Soal</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('school_admin.index') }}">Beranda</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('school_admin.exam-scores.index') }}">Daftar Ujian</a></div>
            <div class="breadcrumb-item"><a href="{{ route('school_admin.exam-scores.indexScore',$exam->id) }}">Daftar Kelas</a></div>
            <div class="breadcrumb-item"><a href="{{route('school_admin.exam-scores.indexScoreExam', [$exam->id,$class->id])}}">{{$class->name}} Peserta {{$exam->name}}</a></div>
            <div class="breadcrumb-item">Detail Pengerjaan</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Detail Pengerjaan Soal {{ $exam->name }} oleh {{$score->student->name}}</h4>
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
                            <td>Tanggal Pelaksanaan</td>
                            <td class="px-2">:</td>
                            <td>{{ \Carbon\Carbon::parse($exam->started_at)->isoFormat('dddd, DD MMMM YYYY') }}</td>
                        </tr>
                        <tr>
                            <td>Nama Siswa</td>
                            <td class="px-2">:</td>
                            <td>{{$score->student->name}}</td>
                        </tr>
                        <tr>
                            <td>Total Poin</td>
                            <td class="px-2">:</td>
                            <td class="font-weight-bold">{{$score->score ?? '-'}}</td>
                        </tr>
                    </table>
                    <hr>
                    @if (!isset($score->score))
                    <div>
                        <h6>Beriku adalah soal yang belum diberikan nilai : </h6>
                        <form action="{{ route('school_admin.exam-scores.update_score', [$exam->id, $class->id, $score->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <ol class="question-list">
                                @foreach (json_decode($score->detail) as $key => $detail)
                                @if(!isset($detail->is_correct))
                                    <li class="question-item">
                                        <div class="question">{!! $exam->examQuestions()->where('id', $detail->question_id)->first()->question !!}</div>
    
                                        <div>
                                            <p class="font-weight-bold mb-0">Jawaban Siswa : </p>
                                            <div class="">{!! $detail->answer !!}</div>
                                        </div>
    
                                        <div class="bg-light py-2 px-3 mt-3 border">
                                            <p class="font-weight-bold mb-0">Rekomendasi Jawaban : </p>
                                            <div>{!! $detail->right_answer !!}</div>
                                        </div>
    
                                        <div class="mt-3">
                                            <input type="hidden" name="scores[{{$key}}][question_id]" value="{{ $detail->question_id }}">
                                            <p class="font-weight-bold mb-0">Nilai : </p>
                                            <input type="number" name="scores[{{$key}}][score]" min="0" max="{{ $detail->poin }}" class="form-control" required>
                                            <span class="text-muted">Maksimal poin : {{ $detail->poin }}</span>
                                        </div>
                                    </li>
                                @endif
                                @endforeach
                                <div class="mt-3 text-right">
                                    <button type="submit" class="btn btn-primary">Selesai</button>
                                </div>
                            </ol>
                        </form>
                    </div>
                    @else
                    <div>
                        <h6>Berikut merupakan rincian pengerjaan : </h6>

                        <ol class="question-list">
                            @foreach (json_decode($score->detail) as $key => $detail)
                            <li class="question-item mb-3">
                                <div class="question">{!! $exam->examQuestions()->where('id', $detail->question_id)->first()->question !!}</div>

                                @if ($detail->type == 'PG')
                                <ol type="a" class="option-list">
                                    @foreach (json_decode($exam->examQuestions()->where('id', $detail->question_id)->first()->option) as $alpha => $option)
                                    <li class="option-item {{ ($detail->right_answer == $alpha) && $detail->is_correct ? 'correct' : ($alpha == $detail->answer ? 'wrong' : '') }}">{!! $option !!}</li>
                                    @endforeach
                                </ol>
                                @endif

                                <div class="bg-light p-2 mt-2 border">
                                    <table class="preview-detail">
                                        <tr>
                                            <td>Jawaban Siswa</td>
                                            <td class="px-2">:</td>
                                            <td class="font-weight-bold ">{!! $detail->answer ?? 'Tidak diisi' !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Kunci Jawaban</td>
                                            <td class="px-2">:</td>
                                            <td class="font-weight-bold ">{!! $detail->right_answer !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Status Jawaban</td>
                                            <td class="px-2">:</td>
                                            <td class="font-weight-bold ">{{ $detail->is_correct ? 'Benar' : 'Salah' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Poin Soal</td>
                                            <td class="px-2">:</td>
                                            <td class="font-weight-bold ">{!! $detail->poin !!}</td>
                                        </tr>
                                    </table>
                                </div>
                            </li>
                            @endforeach
                        </ol>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<script>window.MathJax = { MathML: { extensions: ["mml3.js", "content-mathml.js"]}}</script>
<script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=MML_HTMLorMML"></script>
@endsection