@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tingkat Pendidikan</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Tingkat Pendidikan</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Tingkat Pendidikan</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#kelolaTingkatPendidikan"><i class="fa fa-plus"></i> Tambah Tingkat Pendidikan</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Tingkat</th>
                                <th>Kode Tingkat Pendidikan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($educationLevels as $key => $educationLevel)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $educationLevel->id }}</td>
                                <td>{{ $educationLevel->name }}</td>
                                <td>{{ $educationLevel->level_code }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editEducationLevel" data-id="{{ $educationLevel->id }}" data-name="{{ $educationLevel->name }}" data-level-code="{{ $educationLevel->level_code }}"><i class="fas fa-pencil-alt"></i></button>
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

<div class="modal fade" id="kelolaTingkatPendidikan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('superadmin.education-levels.store') }}" method="POST" id="formKelolaProvince">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><span>Tambah</span> Tingkat Pendidikan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Tingkat Pendidikan</label>
                        <input type="name" class="form-control" id="name" name="name" placeholder="Contoh : SD ,SMP, SMA" required>
                    </div>
                    <div class="form-group">
                        <label for="level_code">Kode Tingkat Pendidikan</label>
                        <input type="level_code" class="form-control" id="level_code" name="level_code" required>
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

<div class="modal fade" id="editEducationLevel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('superadmin.education-levels.update') }}" method="POST" id="formKelolaProvince">
                @csrf
                @method('PUT')
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Edit</span> Tingkat Pendidikan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Tingkat Pendidikan</label>
                        <input type="name" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="level_code">Kode Tingkat Pendidikan</label>
                        <input type="level_code" class="form-control" id="level_code" name="level_code" required>
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
    $('#editEducationLevel').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var name = $(e.relatedTarget).data('name');
        var levelCode = $(e.relatedTarget).data('level-code');

        $('#editEducationLevel').find('input[name="id"]').val(id);
        $('#editEducationLevel').find('input[name="name"]').val(name);
        $('#editEducationLevel').find('input[name="level_code"]').val(levelCode);
    });
</script>
@endpush