@extends('layouts.main')

@section('content')
<style>
    .table-questions img {
        max-width: 200px;
        height: auto;
        margin-bottom: 10px;
    }
</style>
<section class="section">
    <div class="section-header">
        <h1>Ujian Matematika</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('school_admin.index') }}">Beranda</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('school_admin.exams.index') }}">Kumpulan Ujian</a></div>
            <div class="breadcrumb-item">Soal</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Ujian</h4>
                        <div class="card-header-action dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><i class="fa fa-cog"></i> Pengaturan</a>
                            <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <li class="dropdown-title">Pengaturan</li>
                                <li><a href="#editExam" data-toggle="modal" data-target="#editExam" class="dropdown-item">Ubah</a></li>
                                <li class="dropdown-title">Aksi</li>
                                <li><a href="#" class="dropdown-item">Lihat nilai</a></li>
                                @if (!$exam->shared)
                                <li>
                                    <form action="{{ route('school_admin.exams.update_status') }}" method="POST" id="examUpdateStatus">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id" value="{{ $exam->id }}">
                                        <input type="hidden" name="status" value="{{ $exam->status == 'published' ? 'drafted' : 'published' }}">
                                    </form>
                                    <a href="#" onclick="document.getElementById('examUpdateStatus').submit()" class="dropdown-item">{{ $exam->status == 'published' ? 'Arsipkan' : 'Publikasikan' }}</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 py-1">
                                Judul
                            </div>
                            <div class="col-md-8 font-weight-bold py-1">
                                {{ $exam->name }}
                            </div>
                            <div class="col-md-4 py-1">
                                Mata Pel.
                            </div>
                            <div class="col-md-8 font-weight-bold py-1">
                                {{ $exam->examClass->first()->subject->name }}
                            </div>
                            <div class="col-md-4 py-1">
                                Jenis Ujian
                            </div>
                            <div class="col-md-8 font-weight-bold py-1">
                                {{ $exam->examType->name }}
                            </div>
                            <div class="col-md-4 py-1">
                                Jenis Ujian
                            </div>
                            <div class="col-md-8 font-weight-bold py-1">
                                {{ $exam->shared ? 'Serentak' : 'Mandiri' }}
                            </div>
                            <div class="col-md-4 py-1">
                                Tanggal
                            </div>
                            <div class="col-md-8 font-weight-bold py-1">
                                {{ \Carbon\Carbon::parse($exam->started_at)->isoFormat('dddd, DD MMMM YYYY') }}
                            </div>
                            <div class="col-md-4 py-1">
                                Waktu
                            </div>
                            <div class="col-md-8 font-weight-bold py-1">
                                {{ \Carbon\Carbon::parse($exam->started_at)->isoFormat('HH:mm') }} - {{ \Carbon\Carbon::parse($exam->expired_at)->isoFormat('HH:mm') }}
                            </div>
                            <div class="col-md-4 py-1">
                                Durasi
                            </div>
                            <div class="col-md-8 font-weight-bold py-1">
                                {{ $exam->duration }} Menit
                            </div>
                            <div class="col-md-4 py-1">
                                Peserta Kelas
                            </div>
                            <div class="col-md-8 font-weight-bold py-1">
                                @php
                                $strClassess = '';
                                foreach ($classess as $class) {
                                    $strClassess .= "$class->name, ";
                                }
                                $strClassess = rtrim($strClassess, ', ');
                                @endphp

                                {{ $strClassess ?? '-' }}
                            </div>
                            <div class="col-md-4 py-1">
                                Kode Akses
                            </div>
                            <div class="col-md-8 font-weight-bold py-1 text-primary">
                                {{ $exam->access_code }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="far fa-question-circle"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Soal</h4>
                                </div>
                                <div class="card-body">
                                    {{ $exam->examQuestions->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="far fa-file"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Status</h4>
                                </div>
                                <div class="card-body">
                                    {{ $exam->status == 'published' ? 'Dipublikasi' : 'Diarsipkan' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Daftar Soal</h4>
                <div class="card-header-action dropdown">
                    <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><i class="fa fa-cog"></i> Pengaturan</a>
                    <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <li class="dropdown-title">Pengaturan</li>
                        <li><a href="{{ route('school_admin.exams.questions.pratinjau', $exam->id) }}" class="dropdown-item">Pratinjau</a></li>
                        @if (!$exam->shared)
                        <li><a href="{{ route('school_admin.exams.questions.create', $exam->id) }}" class="dropdown-item">Buat soal</a></li>
                        <li><a href="#" class="dropdown-item">Impor soal (.xlsx)</a></li>
                        @endif
                        <li><a href="#" class="dropdown-item">Ekspor soal (.xlsx)</a></li>
                        @if (!$exam->shared)
                        <li><a href="#" class="dropdown-item text-danger">Hapus semua <i class="fa fa-exclamation-circle"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-questions">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tipe</th>
                                <th>Soal</th>
                                <th>Opsi</th>
                                <th>Jawaban</th>
                                <th>Poin</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($exam->examQuestions as $key => $question)
                            <tr>
                                <td class="align-top py-2">{{ ++$key }}</td>
                                <td class="align-top py-2">{{ $question->question_type }}</td>
                                <td class="align-top py-2">{!! $question->question !!}</td>
                                <td class="align-top py-2">
                                    @if ($question->option)
                                    <ol type="a" class="pl-0">
                                        @foreach (json_decode($question->option) as $option)
                                        <li>{!! $option !!}</li>
                                        @endforeach
                                    </ol>
                                    @else
                                    -
                                    @endif
                                </td>
                                <td class="align-top py-2">
                                    {!! $question->answer !!}
                                </td>
                                <td class="align-top py-2">
                                    {{ $question->poin ?? 'Belum dipublikasi' }}
                                </td>
                                <td class="align-top py-2">
                                    <button class="btn btn-sm btn-light d-block" title="Edit"><i class="fa fa-pencil-alt"></i></button>
                                    <button class="btn btn-sm btn-danger mt-2 d-block" title="Hapus"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="7">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="editExam" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('school_admin.exams.update') }}" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Ujian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" value="{{ $exam->id }}">
                    <input type="hidden" name="shared" value="{{ $exam->shared }}">
                    @if (!$exam->shared)
                    <div class="form-group">
                        <label for="name">Judul</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $exam->name }}">
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="subject_id">Mata Pelajaran</label>
                        <select name="subject_id" id="subject_id" class="custom-select">
                            <option value=""></option>
                            @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ $subject->id == $exam->examClass->first()->subject_id ? 'selected' : '' }}>{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if (!$exam->shared)
                    <div class="form-group">
                        <label for="exam_type_id">Jenis Ujian</label>
                        <select name="exam_type_id" id="exam_type_id" class="custom-select">
                            <option value=""></option>
                            @foreach ($exam_types as $exam_type)
                                <option value="{{$exam_type->id}}" {{ $exam_type->id == $exam->exam_type_id ? 'selected' : '' }}>{{ $exam_type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="started_at">Dimulai Pada</label>
                        <input type="datetime-local" name="started_at" id="started_at" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($exam->started_at)) }}">
                    </div>
                    <div class="form-group">
                        <label for="expired_at">Berakhir Pada</label>
                        <input type="datetime-local" name="expired_at" id="expired_at" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($exam->expired_at)) }}">
                    </div>
                    <div class="form-group">
                        <label for="duration">Durasi</label>
                        <input type="number" name="duration" id="duration" class="form-control" value="{{ $exam->duration }}">
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="class_ids">Kelas yang Diizinkan</label>
                        <select name="class_ids[]" id="class_ids" class="js-example-basic-multiple" multiple>
                            <option value=""></option>
                            @foreach ($classess as $class)
                                <option value="{{ $class->id }}"
                                    @foreach (json_decode($exam->examClass->first()->class_ids) as $class_id)
                                        {{ $class_id == $class->id ? 'selected' : '' }}
                                    @endforeach
                                    >{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if (!$exam->shared)
                    <div class="form-group">
                        <label for="access_code">Kode Akses <i class="fa fa-question-circle"></i></label>
                        <input type="text" name="access_code" id="access_code" class="form-control" value="{{ $exam->access_code }}">
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection