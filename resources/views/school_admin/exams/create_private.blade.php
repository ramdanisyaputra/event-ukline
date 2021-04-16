@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Ujian Mandiri</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('school_admin.index') }}">Beranda</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('school_admin.exams.index') }}">Kumpulan Ujian</a></div>
            <div class="breadcrumb-item">Tambah Ujian Mandiri</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Ujian Mandiri</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('school_admin.exams.store_private') }}" method="POST">
                    @csrf
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right my-auto col-12 col-md-3 col-lg-3">Judul Ujian</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right my-auto col-12 col-md-3 col-lg-3">Jenis Ujian</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="exam_type_id" id="exam_type_id" class="custom-select">
                                <option value=""></option>
                                @foreach ($exam_types as $exam_type)
                                    <option value="{{ $exam_type->id }}">{{ $exam_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right my-auto col-12 col-md-3 col-lg-3">Mata Pelajaran</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="subject_id" id="subject_id" class="custom-select">
                                <option value=""></option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right my-auto col-12 col-md-3 col-lg-3">Dimulai Pada</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="datetime-local" name="started_at" id="started_at" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right my-auto col-12 col-md-3 col-lg-3">Berakhir Pada</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="datetime-local" name="expired_at" id="expired_at" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right my-auto col-12 col-md-3 col-lg-3">Durasi</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="number" name="duration" id="duration" class="form-control" min="0">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right my-auto col-12 col-md-3 col-lg-3">Kelas yang Diizinkan</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="js-example-basic-multiple" name="class_ids[]" id="class_ids" multiple>
                                @foreach ($classess as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right my-auto col-12 col-md-3 col-lg-3">Kode Akses <i class="fa fa-question-circle"></i></label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="access_code" id="access_code" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection