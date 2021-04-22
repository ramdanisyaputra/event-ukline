@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Admin Sekolah</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Admin Sekolah</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Admin Sekolah</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#kelolaAdminSekolah"><i class="fa fa-plus"></i> Tambah Admin Sekolah</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Sekolah</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($schoolAdmins as $key => $admin)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->username }}</td>
                                <td>{{ $admin->school->name }}</td>
                                <td class="d-flex justify-content-center" style="gap: 10px;">
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editAdminSekolah" data-id="{{ $admin->id }}" data-name="{{ $admin->name }}" data-username="{{ $admin->username }}" data-school="{{ $admin->school_id }}"><i class="fas fa-pencil-alt"></i></button>
                                    <button title="Atur ulang password" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#confirmResetPassword" data-url="{{ route('superadmin.school-admins.resetPassword', $admin->id) }}" title="Hapus"><i class="fas fa-redo-alt"></i></button>
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

<div class="modal fade" id="kelolaAdminSekolah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('superadmin.school-admins.store') }}" method="POST" id="formKelolaAdminSekolah">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><span>Tambah</span> Admin Sekolah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"> <div class="form-group">
                        <label for="name">Nama Admin</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="school_id">Sekolah</label>
                        <select name="school_id" id="school_id" class="custom-select" required>
                            <option value="" selected></option>
                            @foreach($schools as $school)
                            <option value="{{$school->id}}">{{ $school->name }}</option>
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

<div class="modal fade" id="editAdminSekolah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('superadmin.school-admins.update') }}" method="POST" id="formKelolaAdminSekolah">
                @csrf
                @method('PUT')
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Edit</span> Admin Sekolah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Admin</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="school_id">Sekolah</label>
                        <select name="school_id" id="school_id" class="custom-select" required>
                            <option value="" selected></option>
                            @foreach($schools as $school)
                            <option value="{{$school->id}}">{{ $school->name }}</option>
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

<div class="modal fade" id="confirmResetPassword" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post">
            @csrf
            @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Peringatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah yakin Anda ingin mereset password admin ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


@push('script')
<script>
    $('#editAdminSekolah').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var name = $(e.relatedTarget).data('name');
        var username= $(e.relatedTarget).data('username');
        var school_id = $(e.relatedTarget).data('school');

        $('#editAdminSekolah').find('input[name="id"]').val(id);
        $('#editAdminSekolah').find('input[name="name"]').val(name);
        $('#editAdminSekolah').find('input[name="username"]').val(username);
        $('#editAdminSekolah').find('select[name="school_id"]').val(school_id);
    });
    
    $('#confirmResetPassword').on('show.bs.modal', (e) => {
        var url = $(e.relatedTarget).data('url');

        $(e.currentTarget).find('form').attr('action', url);
    });
</script>
@endpush