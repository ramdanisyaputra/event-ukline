@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Provinsi</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Provinsi</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Provinsi</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#kelolaProvinsi"><i class="fa fa-plus"></i> Tambah Provinsi</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Kode Provinsi</th>
                                <th>Pronvisi</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($provinces as $key => $province)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $province->id }}</td>
                                <td>{{ $province->province_code }}</td>
                                <td>{{ $province->name }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editProvince" data-id="{{ $province->id }}" data-name="{{ $province->name }}" data-province-code="{{ $province->province_code }}"><i class="fas fa-pencil-alt"></i></button>
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

<div class="modal fade" id="kelolaProvinsi" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('superadmin.provinces.store') }}" method="POST" id="formKelolaProvince">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><span>Tambah</span> Provinsi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Provinsi</label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Contoh: Jawa Barat">
                    </div>
                    <div class="form-group">
                        <label for="province_code">Kode Provinsi</label>
                        <input type="text" class="form-control" id="province_code" name="province_code" required>
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

<div class="modal fade" id="editProvince" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('superadmin.provinces.update') }}" method="POST" id="formKelolaProvince">
                @csrf
                @method('PUT')
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Edit</span> Provinsi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Provinsi</label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Contoh: Jawa Barat atau Jawa Timur">
                    </div>
                    <div class="form-group">
                        <label for="province_code">Kode Provinsi</label>
                        <input type="text" class="form-control" id="province_code" name="province_code" required>
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
    $('#editProvince').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var name = $(e.relatedTarget).data('name');
        var province_code= $(e.relatedTarget).data('province-code');

        $('#editProvince').find('input[name="id"]').val(id);
        $('#editProvince').find('input[name="name"]').val(name);
        $('#editProvince').find('input[name="province_code"]').val(province_code);
    });
</script>
@endpush