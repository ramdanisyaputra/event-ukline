@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Kumpulan Ujian</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Kumpulan Ujian</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Ujian</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#kelolaStudent"><i class="fa fa-plus"></i> Tambah Ujian</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-1"> 
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Mulai Pada</th>
                                <th>Berakhir Pada</th>
                                <th>Kode Akses</th>
                                <th>Jenis Ujian</th>
                                <th>Soal Diacak</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($exams as $key => $exam)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $exam->name }}</td>
                                <td>{{ $exam->started_at }}</td>
                                <td>{{ $exam->expired_at }}</td>
                                <td>{{ $exam->access_code }}</td>
                                <td>{{ $exam->examType->name }}</td>
                                <td>{{ $exam->randomized == 1 ? 'Diacak' : 'Tidak Diacak' }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editExam" data-id="{{ $exam->id }}" data-name="{{ $exam->name }}" data-started-at="{{ date('Y-m-d\TH:i', strtotime($exam->started_at)) }}" data-expired-at="{{ date('Y-m-d\TH:i', strtotime($exam->expired_at)) }}" data-access-code="{{ $exam->access_code }}" data-duration="{{ $exam->duration }}" data-exam-type-id="{{ $exam->exam_type_id }}"  data-randomized="{{ $exam->randomized }}"><i class="fas fa-pencil-alt"></i></button>
                                    <a href="{{ route('question_writer.exams.questions.index', $exam->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="kelolaStudent" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('question_writer.exams.store')}}" method="POST" id="formKelolaExam">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><span>Tambah</span> Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Ujian</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="started_at">Dimulai Pada</label>
                        <input type="datetime-local" class="form-control" name="started_at" id="started_at">
                    </div>
                    <div class="form-group">
                        <label for="expired_at">Berakhir Pada</label>
                        <input type="datetime-local" class="form-control" name="expired_at" id="expired_at">
                    </div>
                    <div class="form-group">
                        <label for="duration">Durasi</label>
                        <input type="number" class="form-control" name="duration" id="duration">
                    </div>
                    <div class="form-group">
                        <label for="access_code">Kode Akses</label>
                        <input type="text" class="form-control" name="access_code" id="access_code">
                    </div>
                    <div class="form-group">
                        <label for="exam_type_id">Jenis Ujian</label>
                        <select name="exam_type_id" id="exam_type_id" class="form-control" required>
                            <option value=""> ~ Pilih ~</option>
                            @foreach($examTypes as $exam)
                                <option value="{{$exam->id}}">{{$exam->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="randomized">Soal Diacak</label>
                        <select name="randomized" id="randomized" class="form-control" required>
                            <option value=""> ~ Pilih ~</option>
                            <option value="0">Tidak Diacak</option>
                            <option value="1">Diacak</option>
                        </select>
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


<div class="modal fade" id="editExam" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('question_writer.exams.update')}}" method="POST" id="formKelolaExam">
                @csrf
                @method('PUT')
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Edit</span> Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Ujian</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="started_at">Dimulai Pada</label>
                        <input type="datetime-local" class="form-control" name="started_at" id="started_at">
                    </div>
                    <div class="form-group">
                        <label for="expired_at">Berakhir Pada</label>
                        <input type="datetime-local" class="form-control" name="expired_at" id="expired_at">
                    </div>
                    <div class="form-group">
                        <label for="duration">Durasi</label>
                        <input type="number" class="form-control" name="duration" id="duration">
                    </div>
                    <div class="form-group">
                        <label for="access_code">Kode Akses</label>
                        <input type="text" class="form-control" name="access_code" id="access_code">
                    </div>
                    <div class="form-group">
                        <label for="exam_type_id">Jenis Ujian</label>
                        <select name="exam_type_id" id="exam_type_id" class="form-control" required>
                            <option value=""> ~ Pilih ~</option>
                            @foreach($examTypes as $exam)
                                <option value="{{$exam->id}}">{{$exam->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="randomized">Soal Diacak</label>
                        <select name="randomized" id="randomized" class="form-control" required>
                            <option value=""> ~ Pilih ~</option>
                            <option value="0">Tidak Diacak</option>
                            <option value="1">Diacak</option>
                        </select>
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

@endsection


@push('script')
<script>
    $('#editExam').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var name = $(e.relatedTarget).data('name');
        var startedAt= $(e.relatedTarget).data('started-at');
        var expiredAt= $(e.relatedTarget).data('expired-at');
        var duration= $(e.relatedTarget).data('duration');
        var accessCode= $(e.relatedTarget).data('access-code');
        var examTypeId= $(e.relatedTarget).data('exam-type-id');
        var randomized= $(e.relatedTarget).data('randomized');

        $('#editExam').find('input[name="id"]').val(id);
        $('#editExam').find('input[name="name"]').val(name);
        $('#editExam').find('input[name="started_at"]').val(startedAt);
        $('#editExam').find('input[name="expired_at"]').val(expiredAt);
        $('#editExam').find('input[name="duration"]').val(duration);
        $('#editExam').find('input[name="access_code"]').val(accessCode);
        $('#editExam').find('select[name="exam_type_id"]').val(examTypeId);
        $('#editExam').find('select[name="randomized"]').val(randomized);
    });
</script>
@endpush