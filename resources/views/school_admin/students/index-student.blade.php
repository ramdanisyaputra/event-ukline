@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Siswa {{$class->name}}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Siswa {{$class->name}}</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Siswa {{$class->name}}</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#kelolaStudent"><i class="fa fa-plus"></i> Tambah Siswa {{$class->name}}</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>JK</th>
                                <th>Nomor Peserta</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $key => $student)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $student->nisn }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->pob }}</td>
                                <td>{{ $student->dob }}</td>
                                <td>{{ $student->gender }}</td>
                                <td>{{ $student->student_number }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editStudent" data-id="{{ $student->id }}" data-nisn="{{ $student->nisn }}" data-nis="{{ $student->nis }}" data-name="{{ $student->name }}" data-pob="{{ $student->pob }}" data-dob="{{ $student->dob }}" data-gender="{{ $student->gender }}" data-student-number="{{ $student->student_number }}" data-username="{{ $student->username }}"><i class="fas fa-pencil-alt"></i></button>

                                    <a href="{{route('school_admin.students.resetPasswordStudent', [$student->class_id , $student->id])}}" class="btn btn-sm btn-warning" onclick="return confirm('Apakah anda yakin? ')">Reset Password</a>
                                    
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="kelolaStudent" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('school_admin.students.store',$class->id) }}" method="POST" id="formkelolaStudents">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><span>Tambah</span> Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <input type="number" class="form-control" id="nisn" name="nisn" required>
                    </div>
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="number" class="form-control" id="nis" name="nis" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="pob">Tempat Lahir</label>
                        <input type="text" class="form-control" id="pob" name="pob" required>
                    </div>
                    <div class="form-group">
                        <label for="dob">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                    <div class="form-group">
                        <label for="student_number">Nomor Peserta</label>
                        <input type="text" class="form-control" id="student_number" name="student_number" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Jenis Kelamin</label>
                        <select name="gender" id="gender" class="custom-select" required>
                            <option value="" disabled selected></option>
                            <option value="L">Laki - laki</option>
                            <option value="P">Perempuan</option>
                        </select>
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

<div class="modal fade" id="editStudent" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('school_admin.students.update',$class->id) }}" method="POST" id="formkelolaStudents">
                @csrf
                @method('PUT')
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Edit</span> Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <input type="number" class="form-control" id="nisn" name="nisn" required>
                    </div>
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="number" class="form-control" id="nis" name="nis" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="pob">Tempat Lahir</label>
                        <input type="text" class="form-control" id="pob" name="pob" required>
                    </div>
                    <div class="form-group">
                        <label for="dob">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                    <div class="form-group">
                        <label for="student_number">Nomor Peserta</label>
                        <input type="text" class="form-control" id="student_number" name="student_number" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Jenis Kelamin</label>
                        <select name="gender" id="gender" class="custom-select" required>
                            <option value="L">Laki - laki</option>
                            <option value="P">Perempuan</option>
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
    $('#editStudent').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var nisn = $(e.relatedTarget).data('nisn');
        var nis= $(e.relatedTarget).data('nis');
        var name= $(e.relatedTarget).data('name');
        var pob= $(e.relatedTarget).data('pob');
        var dob= $(e.relatedTarget).data('dob');
        var studentNumber= $(e.relatedTarget).data('student-number');
        var gender= $(e.relatedTarget).data('gender');

        $('#editStudent').find('input[name="id"]').val(id);
        $('#editStudent').find('input[name="nisn"]').val(nisn);
        $('#editStudent').find('input[name="nis"]').val(nis);
        $('#editStudent').find('input[name="name"]').val(name);
        $('#editStudent').find('input[name="pob"]').val(pob);
        $('#editStudent').find('input[name="dob"]').val(dob);
        $('#editStudent').find('input[name="student_number"]').val(studentNumber);
        $('#editStudent').find('select[name="gender"]').val(gender);
    });
</script>
@endpush