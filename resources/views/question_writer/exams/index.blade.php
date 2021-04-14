@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Ujian</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Ujian</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Kelola Ujian</h4>
                <div class="card-header-action">
                    <a class="btn btn-primary" href="{{ route('question_writer.exams.create') }}" ><i class="fa fa-plus"></i> Tambah Ujian</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Mulai Pada</th>
                                <th>Berakhir Pada</th>
                                <th>Kode Akses</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($exams as $key => $exam)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $exam->name }}</td>
                                <td>{{ $exam->started_at }}</td>
                                <td>{{ $exam->expired_at }}</td>
                                <td>{{ $exam->access_code }}</td>
                                <td class="text-center">
                                    <a href="{{route('superadmin.faqs.edit', $exam->id)}}" class="btn btn-success btn-sm"> <i class="fas fa-edit"></i> </a>
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
