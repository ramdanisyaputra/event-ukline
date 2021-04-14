@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Ujian Serentak</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('school_admin.index') }}">Beranda</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('school_admin.exams.index') }}">Kumpulan Ujian</a></div>
            <div class="breadcrumb-item">Tambah Ujian Serentak</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Ujian Serentak</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right my-auto col-12 col-md-3 col-lg-3">Pilih Ujian</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="" id="" class="custom-select">
                                <option value=""></option>
                                @foreach ($exams as $exam)
                                    <option value="{{$exam->id}}">{{ $exam->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right my-auto col-12 col-md-3 col-lg-3">Mata Pelajaran</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="" id="" class="custom-select">
                                <option value=""></option>
                                @foreach ($subjects as $subject)
                                    <option value="{{$subject->id}}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kelas yang diizinkan</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="class_ids[]" id="class_ids" class="js-example-basic-multiple border-0" multiple>
                                @foreach ($classess as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection