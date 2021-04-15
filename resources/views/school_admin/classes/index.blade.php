@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Kelas</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Kelas</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Kelas</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#kelolaKelas"><i class="fa fa-plus"></i> Tambah Kelas</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kelas</th>
                                <th>Sekolah</th>
                                <th>Tingkat Kelas</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($classes as $key => $class)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $class->name }}</td>
                                <td>{{ $class->school->name }}</td>
                                <td>{{ $class->grade->number }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editClass" data-id="{{ $class->id }}" data-name="{{ $class->name }}" data-grade-id="{{ $class->grade_id }}"><i class="fas fa-pencil-alt"></i></button>
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

<div class="modal fade" id="kelolaKelas" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('school_admin.classes.store') }}" method="POST" id="formKelolaProvince">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><span>Tambah</span> Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Kelas</label>
                        <input type="name" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Tingkat Kelas</label>
                        <select name="grade_id" id="grade_id" class="custom-select" required>
                            <option value="" disabled selected></option>
                            @foreach($grades as $grade)
                            <option value="{{$grade->id}}">{{$grade->number}}</option>
                            @endforeach
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

<div class="modal fade" id="editClass" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('school_admin.classes.update') }}" method="POST" id="formKelolaProvince">
                @csrf
                @method('PUT')
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Edit</span> Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Kelas</label>
                        <input type="name" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Tingkat Kelas</label>
                        <select name="grade_id" id="grade_id" class="custom-select" required>
                            <option value="" disabled selected></option>
                            @foreach($grades as $grade)
                            <option value="{{$grade->id}}">{{$grade->number}}</option>
                            @endforeach
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
    $('#editClass').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var name = $(e.relatedTarget).data('name');
        var gradeId = $(e.relatedTarget).data('grade-id');

        $('#editClass').find('input[name="id"]').val(id);
        $('#editClass').find('input[name="name"]').val(name);
        $('#editClass').find('select[name="grade_id"]').val(gradeId);
    });
</script>
@endpush