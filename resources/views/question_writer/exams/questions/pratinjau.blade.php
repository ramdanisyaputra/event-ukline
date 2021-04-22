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

    .question-item {
        margin-bottom: 20px;
    }

    .option-item.correct {
        color: #47c363;
        font-weight: 900 !important;
    }
</style>
<section class="section">
    <div class="section-header">
        <h1>Pratinjau Soal</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('question_writer.index') }}">Beranda</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('question_writer.exams.index') }}">Kumpulan Ujian</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('question_writer.exams.questions.index', $exam->id) }}">{{ $exam->name }}</a></div>
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
                    <ol class="question-list">
                    @foreach($examQuestions as $examQuestion)
                        <li class="question-item">
                            <div class="question">{!! $examQuestion->question !!}</div>
                            @if($examQuestion->question_type == 'PG')
                            <ol type="a" class="option-list">
                                @foreach (json_decode($examQuestion->option) as $key => $option)
                                <li class="{{ $key == $examQuestion->answer ? 'correct' : '' }} option-item">{!! $option !!}</li>
                                @endforeach
                            </ol>
                            @else
                            <div class="py-2 px-3 bg-light mt-2">
                                <p class="font-weight-bold mb-0">Rekomendasi Jawaban</p>
                                {!! $examQuestion->answer !!}
                            </div>
                            @endif
                        </li>
                    @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection