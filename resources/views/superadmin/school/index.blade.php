@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Sekolah</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Sekolah</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Sekolah</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#kelolaSekolah"><i class="fa fa-plus"></i> Tambah Sekolah</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kepala Sekolah</th>
                                <th>Regensi</th>
                                <th>Tingkat Pendidikan</th>
                                <th>Alamat</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($schools as $key => $school)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $school->name }}</td>
                                <td>{{ $school->headmaster_name }}</td>
                                <td>{{ $school->regency->name }}</td>
                                <td>{{ $school->educationLevel->name }}</td>
                                <td>{{ $school->address }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editSekolah" data-id="{{ $school->id }}" data-name="{{ $school->name }}" data-headmaster-name="{{ $school->headmaster_name }}" data-regency="{{ $school->regency_id }}" data-education-level="{{ $school->education_level_id }}" data-address="{{ $school->address }}"><i class="fas fa-pencil-alt"></i></button>
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

<div class="modal fade" id="kelolaSekolah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('superadmin.schools.store') }}" method="POST" id="formKelolaSekolah">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><span>Tambah</span> Sekolah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                        <label for="name">Nama Sekolah</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required placeholder="Contoh: SMP 1">
                    </div>
                    <div class="form-group">
                        <label for="headmaster_name">Kepala Sekolah</label>
                        <input type="text" class="form-control" id="headmaster_name" name="headmaster_name" value="{{old('headmaster_name')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea class="form-control" id="address" name="address" required>{{old('address')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="regency_id">Regensi</label>
                        <select name="regency_id" id="regency_id" class="custom-select" required>
                            <option value="" selected></option>
                            @foreach($regencies as $regency)
                            <option value="{{$regency->id}}">{{ $regency->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="education_level_id">Tingkat Pendidikan</label>
                        <select name="education_level_id" id="education_level_id" class="custom-select" required>
                            <option value="" selected></option>
                            @foreach($educationLevels as $education)
                            <option value="{{$education->id}}">{{ $education->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status Event</label>
                        <select name="status" id="status" class="custom-select" required>
                            <option value="" selected> </option>
                            <option value="tryout">Try Out</option>
                            <option value="resmi">Resmi</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="active_status">Status Sekolah</label>
                        <select name="active_status" id="active_status" class="custom-select" required>
                            <option value="" selected> </option>
                            <option value="0">Tidak Aktif</option>
                            <option value="1">Aktif</option>
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

<div class="modal fade" id="editSekolah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('superadmin.schools.update') }}" method="POST" id="formKelolaSekolah">
                @csrf
                @method('PUT')
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Edit</span> Sekolah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Sekolah</label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Contoh: SMP 1">
                    </div>
                    <div class="form-group">
                        <label for="headmaster_name">Kepala Sekolah</label>
                        <input type="text" class="form-control" id="headmaster_name" name="headmaster_name" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea class="form-control" id="address" name="address" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="regency_id">Regensi</label>
                        <select name="regency_id" id="regency_id" class="custom-select" required>
                            <option value=""></option>
                            @foreach($regencies as $regency)
                            <option value="{{$regency->id}}">{{ $regency->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="education_level_id">Tingkat Pendidikan</label>
                        <select name="education_level_id" id="education_level_id" class="custom-select" required>
                            <option value=""></option>
                            @foreach($educationLevels as $education)
                            <option value="{{$education->id}}">{{ $education->name }}</option>
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
    $('#editSekolah').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var name = $(e.relatedTarget).data('name');
        var headmasterName= $(e.relatedTarget).data('headmaster-name');
        var regencyId = $(e.relatedTarget).data('regency');
        var educationLevelId = $(e.relatedTarget).data('education-level');
        var address = $(e.relatedTarget).data('address');

        $('#editSekolah').find('input[name="id"]').val(id);
        $('#editSekolah').find('input[name="name"]').val(name);
        $('#editSekolah').find('input[name="headmaster_name"]').val(headmasterName);
        $('#editSekolah').find('textarea[name="address"]').val(address);
        $('#editSekolah').find('select[name="regency_id"]').val(regencyId);
        $('#editSekolah').find('select[name="education_level_id"]').val(educationLevelId);
        $('#editSekolah').find('select[name="address"]').val(address);
    });
</script>
@endpush