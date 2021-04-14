@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Ujian</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Ujian</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Kelola Ujian</h4>
                <div class="card-header-action">
                    <a class="btn btn-primary" href="{{ route('question_writer.exams.questions.create') }}" ><i class="fa fa-plus"></i> Tambah Ujian</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pertanyaan</th>
                                <th>Poin</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($examQuestions as $key => $question)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $question->question }}</td>
                                <td>{{ $question->poin }}</td>
                                <td class="text-center">
                                    <a href="{{route('question_writer.exams.edit', $question->id)}}" class="btn btn-warning btn-sm"> <i class="fas fa-edit"></i> </a>
                                    <a href="{{route('question_writer.exams.show', $question->id)}}" class="btn btn-success btn-sm"> <i class="fas fa-eye"></i> </a>
                                    <a href="{{route('question_writer.exams.questions.index', $question->id)}}" class="btn btn-primary btn-sm"> <i class="fas fa-plus"></i> </a>
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
