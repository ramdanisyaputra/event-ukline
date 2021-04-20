@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Master Kelas</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Master Kelas</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Master Kelas</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#kelolaMasterKelas"><i class="fa fa-plus"></i> Tambah Master Kelas</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Number</th>
                                <th>Roman</th>
                                <th>Tingkat Pendidikan</th>
                                <th>Tahun Ajaran</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($grades as $key => $grade)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $grade->id }}</td>
                                <td>{{ $grade->number }}</td>
                                <td>{{ $grade->roman }}</td>
                                <td>{{ $grade->educationLevel->name }}</td>
                                <td>{{ $grade->school_year }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editGrade" data-id="{{ $grade->id }}" data-number="{{ $grade->number }}" data-roman="{{ $grade->roman }}" data-education-level="{{ $grade->education_level_id }}" data-school-year="{{ $grade->school_year }}"><i class="fas fa-pencil-alt"></i></button>
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

<div class="modal fade" id="kelolaMasterKelas" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('superadmin.grades.store') }}" method="POST" id="formKelolaProvince">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><span>Tambah</span> Master Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="number">Nomor Kelas</label>
                        <input type="number" class="form-control" id="number" name="number" required placeholder="Contoh: 1,2,3,4,5,6,7,8,9,10,11,12">
                    </div>
                    <div class="form-group">
                        <label for="roman">Romawi Kelas</label>
                        <input type="text" class="form-control" id="roman" name="roman" required>
                    </div>
                    <div class="form-group">
                        <label for="school_year">Tahun Ajaran</label>
                        <input type="text" class="form-control" id="school_year" name="school_year" required>
                    </div>
                    <div class="form-group">
                        <label for="education_level_id">Tingkat Pendidikan</label>
                        <select name="education_level_id" id="education_level_id" class="custom-select" required>
                            <option value=""></option>
                            @foreach($educationLevels as $educationLevel)
                            <option value="{{$educationLevel->id}}">{{ $educationLevel->name }}</option>
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

<div class="modal fade" id="editGrade" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('superadmin.grades.update') }}" method="POST" id="formKelolaProvince">
                @csrf
                @method('PUT')
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Edit</span> Master Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                        <label for="number">Nomor Kelas</label>
                        <input type="number" class="form-control" id="number" name="number" required placeholder="Contoh: 1,2,3,4,5,6,7,8,9,10,11,12">
                    </div>
                    <div class="form-group">
                        <label for="roman">Romawi Kelas</label>
                        <input type="text" class="form-control" id="roman" name="roman" required>
                    </div>
                    <div class="form-group">
                        <label for="school_year">Tahun Ajaran</label>
                        <input type="text" class="form-control" id="school_year" name="school_year" required>
                    </div>
                    <div class="form-group">
                        <label for="education_level_id">Tingkat Pendidikan</label>
                        <select name="education_level_id" id="education_level_id" class="custom-select" required>
                            <option value=""></option>
                            @foreach($educationLevels as $educationLevel)
                            <option value="{{$educationLevel->id}}">{{ $educationLevel->name }}</option>
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
    $('#editGrade').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var number = $(e.relatedTarget).data('number');
        var roman = $(e.relatedTarget).data('roman');
        var educationLevelId = $(e.relatedTarget).data('education-level');
        var school_year= $(e.relatedTarget).data('school-year');

        $('#editGrade').find('input[name="id"]').val(id);
        $('#editGrade').find('input[name="number"]').val(number);
        $('#editGrade').find('input[name="roman"]').val(roman);
        $('#editGrade').find('select[name="education_level_id"]').val(educationLevelId);
        $('#editGrade').find('input[name="school_year"]').val(school_year);
    });
</script>
@endpush