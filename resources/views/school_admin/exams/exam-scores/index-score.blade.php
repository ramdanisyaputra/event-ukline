@extends('layouts.main')

@section('content')
<style>
.set-button{
    font-size: 14px;
    letter-spacing: normal;
    padding: 10px 20px;
    color: #6c757d;
}
</style>
<section class="section">
    <div class="section-header">
        <h1>Daftar kelas yang mengikuti {{$exam->name}}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Daftar Kelas yang mengikuti {{$exam->name}}</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar kelas yang mengikuti {{$exam->name}}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kelas</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (json_decode($examClass->class_ids) as $key => $ids)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{DB::table('classes')->where('id',$ids)->first()->name}}</td>
                                <td class="text-center">
                                    <a href="{{route('school_admin.exam-scores.indexScore', $exam->id)}}" class="btn btn-success">Pilih Kelas</a>
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
