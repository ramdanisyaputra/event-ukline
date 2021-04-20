@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Kelas</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Daftar Kelas</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Kelas</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kelas</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($classes as $key => $class)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $class->name }}</td>
                                <td class="text-center">
                                    <a href="{{route('school_admin.students.indexStudent', $class->id)}}" class="btn btn-success">Pilih Kelas</a>
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
@endsection