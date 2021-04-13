@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Regensi</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Regensi</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Regensi</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#kelolaRegen"><i class="fa fa-plus"></i> Tambah Regensi</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Regensi</th>
                                <th>Pronvisi</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($regencies as $key => $regency)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $regency->regency_code }}</td>
                                <td>{{ $regency->name }}</td>
                                <td>{{ $regency->province->name }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editRegen" data-id="{{ $regency->id }}" data-name="{{ $regency->name }}" data-province="{{ $regency->province_id }}" data-regency-code="{{ $regency->regency_code }}"><i class="fas fa-pencil-alt"></i></button>
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

<div class="modal fade" id="kelolaRegen" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('superadmin.regencies.store') }}" method="POST" id="formKelolaRegen">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><span>Tambah</span> Regensi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Regensi</label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Contoh: Kota Bekasi atau Kabupaten Bekasi">
                    </div>
                    <div class="form-group">
                        <label for="regency_code">Kode Regensi</label>
                        <input type="text" class="form-control" id="regency_code" name="regency_code" required>
                    </div>
                    <div class="form-group">
                        <label for="province_id">Provinsi</label>
                        <select name="province_id" id="province_id" class="custom-select" required>
                            <option value=""></option>
                            @foreach($provinces as $province)
                            <option value="{{$province->id}}">{{ $province->name }}</option>
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

<div class="modal fade" id="editRegen" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('superadmin.regencies.update') }}" method="POST" id="formKelolaRegen">
                @csrf
                @method('PUT')
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Edit</span> Regensi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Regensi</label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Contoh: Kota Bekasi atau Kabupaten Bekasi">
                    </div>
                    <div class="form-group">
                        <label for="regency_code">Kode Regensi</label>
                        <input type="text" class="form-control" id="regency_code" name="regency_code" required>
                    </div>
                    <div class="form-group">
                        <label for="province_id">Provinsi</label>
                        <select name="province_id" id="province_id" class="custom-select" required>
                            <option value=""></option>
                            @foreach($provinces as $province)
                            <option value="{{$province->id}}">{{ $province->name }}</option>
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
    $('#editRegen').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var name = $(e.relatedTarget).data('name');
        var regencyCode= $(e.relatedTarget).data('regency-code');
        var provinceId = $(e.relatedTarget).data('province');

        $('#editRegen').find('input[name="id"]').val(id);
        $('#editRegen').find('input[name="name"]').val(name);
        $('#editRegen').find('input[name="regency_code"]').val(regencyCode);
        $('#editRegen').find('select[name="province_id"]').val(provinceId);
    });
</script>
@endpush