@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Penulis Soal</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Penulis Soal {{$regency->name}}</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Penulis Soal</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#kelolaQuestionWriter"><i class="fa fa-plus"></i> Tambah Penulis Soal {{$regency->name}}</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($questionWriters as $key => $questionWriter)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $questionWriter->id }}</td>
                                <td>{{ $questionWriter->name }}</td>
                                <td>{{ $questionWriter->username }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editQuestionWriter" data-id="{{ $questionWriter->id }}" data-name="{{ $questionWriter->name }}" data-username="{{ $questionWriter->username }}"><i class="fas fa-pencil-alt"></i></button>
                                    <a href="{{route('superadmin.question-writers.resetPasswordWriter', [$questionWriter->regency_id , $questionWriter->id])}}" class="btn btn-sm btn-warning" onclick="return confirm('Apakah anda yakin? ')">Reset Password</a>
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

<div class="modal fade" id="kelolaQuestionWriter" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('superadmin.question-writers.store',$regency->id) }}" method="POST" id="formKelolaQuestionWriters">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><span>Tambah</span> Penulis Soal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
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

<div class="modal fade" id="editQuestionWriter" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('superadmin.question-writers.update',$regency->id) }}" method="POST" id="formKelolaQuestionWriters">
                @csrf
                @method('PUT')
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Edit</span> Penulis Soal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
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
    $('#editQuestionWriter').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var name = $(e.relatedTarget).data('name');
        var username= $(e.relatedTarget).data('username');

        $('#editQuestionWriter').find('input[name="id"]').val(id);
        $('#editQuestionWriter').find('input[name="name"]').val(name);
        $('#editQuestionWriter').find('input[name="username"]').val(username);
    });
</script>
@endpush