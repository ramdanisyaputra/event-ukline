@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Ujian</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Ujian </div>
            <div class="breadcrumb-item">Ubah</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Ubah Ujian</h4>
            </div>
            <div class="card-body">
                <form action="{{route('question_writer.exams.update')}}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $exam->id }}">
                    <div class="form-group">
                        <label for="name">Nama Ujian</label>
                        <input type="text" class="form-control" value="{{$exam->name}}" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="started_at">Dimulai Pada</label>
                        <input type="datetime-local" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($exam->started_at)) }}" name="started_at" id="started_at">
                    </div>
                    <div class="form-group">
                        <label for="expired_at">Berakhir Pada</label>
                        <input type="datetime-local" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($exam->expired_at)) }}" name="expired_at" id="expired_at">
                    </div>
                    <div class="form-group">
                        <label for="duration">Durasi</label>
                        <input type="number" class="form-control" value="{{$exam->duration}}" name="duration" id="duration">
                    </div>
                    <div class="form-group">
                        <label for="access_code">Kode Akses</label>
                        <input type="text" class="form-control" value="{{$exam->access_code}}" name="access_code" id="access_code">
                    </div>
                    <div class="form-group">
                        <label for="exam_type_id">Jenis Ujian</label>
                        <select name="exam_type_id" id="exam_type_id" class="form-control" required>
                            <option value=""> ~ Pilih ~</option>
                            @foreach($examTypes as $examType)
                                @if($examType->id == $exam->exam_type_id)
                                    <option value="{{$examType->id}}" selected>{{$examType->name}}</option>
                                @else
                                    <option value="{{$examType->id}}">{{$examType->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <a href="{{ route('question_writer.exams.index') }}" class="btn btn-warning">Kembali</a>
                </form>
            </div>
        </div>

    </div>
</section>

@endsection
