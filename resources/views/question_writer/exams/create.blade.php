@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Ujian</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Ujian </div>
            <div class="breadcrumb-item">Tambah</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Ubah Ujian</h4>
            </div>
            <div class="card-body">
                <form action="{{route('question_writer.exams.store')}}" method="post">
                    @csrf
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
                <button class="btn btn-primary" type="submit">Simpan</button>
                </form>
            </div>
        </div>

    </div>
</section>

@endsection

@push('script')
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });

    $('#editFaq').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var name = $(e.relatedTarget).data('name');
        var tags = $(e.relatedTarget).data('tags');
        var question= $(e.relatedTarget).data('question');
        var answer= $(e.relatedTarget).data('answer');

        $('#editFaq').find('input[name="id"]').val(id);
        $('#editFaq').find('input[name="tags"]').val(tags);
        $('#editFaq').find('input[name="name"]').val(name);
        $('#editFaq').find('input[name="question"]').val(question);
        $('#editFaq').find('input[name="answer"]').val(answer);
    });
</script>
@endpush    