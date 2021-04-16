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
            <div class="breadcrumb-item active"><a href="{{ route('question_writer.index') }}">Beranda</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('question_writer.exams.index') }}">Kumpulan Ujian</a></div>
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
                                <!-- <li><a href="#editExam" data-toggle="modal" data-target="#editExam" class="dropdown-item">Ubah</a></li> -->
                                <li class="dropdown-title">Pengaturan</li>
                                <li><a href="#" class="dropdown-item">Lihat nilai</a></li>
                                <li>
                                    <form action="{{ route('question_writer.exams.update_status') }}" method="POST" id="examUpdateStatus">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id" value="{{ $exam->id }}">
                                        <input type="hidden" name="status" value="{{ $exam->status == 'published' ? 'drafted' : 'published' }}">
                                    </form>
                                    <a href="#" onclick="document.getElementById('examUpdateStatus').submit()" class="dropdown-item">{{ $exam->status == 'published' ? 'Arsipkan' : 'Publikasikan' }}</a>
                                </li>
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
                                Jenis Ujian
                            </div>
                            <div class="col-md-8 font-weight-bold py-1">
                                {{ $exam->examType->name }}
                            </div>
                            <div class="col-md-4 py-1">
                                Jenis Ujian
                            </div>
                            <div class="col-md-8 font-weight-bold py-1">
                                {{ $exam->shared == 0 ? 'Serentak' : 'Mandiri' }}
                            </div>
                            <div class="col-md-4 py-1">
                                Dilaksanakan
                            </div>
                            <div class="col-md-8 font-weight-bold py-1">
                                {{ \Carbon\Carbon::parse($exam->started_at)->isoFormat('dddd, DD MMMM YYYY') }}
                            </div>
                            <div class="col-md-4 py-1">
                                Berakhir
                            </div>
                            <div class="col-md-8 font-weight-bold py-1">
                                {{ \Carbon\Carbon::parse($exam->expired_at)->isoFormat('dddd, DD MMMM YYYY') }}
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
                        <li><a href="{{ route('question_writer.exams.questions.pratinjau', $exam->id) }}" class="dropdown-item">Pratinjau</a></li>
                        @if ($exam->status == 'drafted')
                        <li><a href="{{ route('question_writer.exams.questions.create', $exam->id) }}" class="dropdown-item">Buat soal</a></li>
                        <li><a data-toggle="modal" data-target="#import" class="dropdown-item">Impor soal (.xlsx)</a></li>
                        @endif
                        <li><a href="{{ route('question_writer.exams.questions.export', $exam->id) }}" class="dropdown-item">Ekspor soal (.xlsx)</a></li>
                        <li><a href="{{ route('question_writer.exams.questions.pdf', $exam->id) }}" target="_blank" class="dropdown-item">Ekspor soal (.pdf)</a></li>
                        @if ($exam->status == 'drafted')
                        <li><a href="#" data-toggle="modal" data-target="#confirmDeleteAll" class="dropdown-item text-danger">Hapus semua <i class="fa fa-exclamation-circle"></i></a></li>
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
                                    @if($exam->status == 'drafted')
                                    <a href="{{ route('question_writer.exams.questions.edit', [$exam->id, $question->id]) }}" class="btn btn-sm btn-light d-block" title="Edit"><i class="fa fa-pencil-alt"></i></a>
                                    <button class="btn btn-sm btn-danger mt-2 d-block" data-toggle="modal" data-target="#confirmDelete" data-url="{{ route('question_writer.exams.questions.delete', [$exam->id, $question->id]) }}" title="Hapus"><i class="fa fa-trash"></i></button>
                                    @else
                                        Arsipkan ujian untuk mengubah soal
                                    @endif
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
                    @if (!$exam->shared)
                    <div class="form-group">
                        <label for="exam_type_id">Jenis Ujian</label>
                        <select name="exam_type_id" id="exam_type_id" class="custom-select">
                            <option value=""></option>
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


<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('question_writer.exams.questions.import',$exam->id) }}" method="POST" id="formkelolaStudents" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><span>Import</span> Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <h6 for="file">Download Panduan</h6>
                        <a href="{{asset('panduan')}}" class="nav-link">Download Panduan Import Siswa Berikut</a>
                    </div>
                    <div class="form-group">
                        <label for="file">Data Excel</label>
                        <input type="file" class="form-control" id="file" name="file" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post">
            @csrf
            @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Peringatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah yakin Anda ingin menghapus soal ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmDeleteAll" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('question_writer.exams.questions.delete_all', $exam->id) }}" method="post">
            @csrf
            @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Peringatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah yakin Anda ingin menghapus <strong>semua soal ujian</strong> ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
    $('#confirmDelete').on('show.bs.modal', (e) => {
        var url = $(e.relatedTarget).data('url');

        $(e.currentTarget).find('form').attr('action', url);
    });
</script>
@endpush