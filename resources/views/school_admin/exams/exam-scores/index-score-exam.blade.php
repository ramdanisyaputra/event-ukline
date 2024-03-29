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
        <h1>{{$class->name}} Peserta {{$exam->name}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('school_admin.index') }}">Beranda</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('school_admin.exam-scores.index') }}">Daftar Ujian</a></div>
            <div class="breadcrumb-item"><a href="{{ route('school_admin.exam-scores.indexScore',$exam->id) }}">Daftar Kelas</a></div>
            <div class="breadcrumb-item">{{$class->name}} Peserta {{$exam->name}}</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>{{$class->name}} Peserta {{$exam->name}}</h4>
                <div class="card-header-action">
                    <a href="{{route('school_admin.exam-scores.exportExam', [$exam->id,$class->id])}}" class="btn btn-success">Export Excel</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NISN</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Nilai</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($class->students()->orderBy('name', 'ASC')->get() as $key => $student)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $student->nisn }}</td>
                                <td>{{ $student->nis }}</td>
                                <td>{{ $student->name }}</td>
                                @php
                                    $examScore = $student->examScores()->where('exam_id', $exam->id)->first();
                                @endphp
                                <td>
                                    {{ $examScore ? \Carbon\Carbon::parse($examScore->time_start)->isoFormat('dddd, DD MMMM  YYYY HH:mm') : '-' }}
                                </td>
                                <td>
                                    {{ $examScore ? \Carbon\Carbon::parse($examScore->time_finish)->isoFormat('dddd, DD MMMM YYYY HH:mm') : '-' }}
                                </td>
                                <td>
                                    {{ isset($examScore) ? ($examScore->score ?? 'Belum Dinilai') : 'Belum Mengerjakan' }}
                                </td>
                                <td class="text-center">
                                    <div class="d-inline d-flex">
                                        @if($examScore)
                                        <a href="{{route('school_admin.exam-scores.detail',[$exam->id,$class->id,$examScore->id])}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                        <button class="btn btn-sm btn-danger ml-1" data-toggle="modal" data-target="#confirmDelete" data-url="{{ route('school_admin.exam-scores.deleteScoreStudent', $examScore->id) }}" title="Hapus"><i class="fa fa-trash"></i></button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post">
            @csrf
            @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Peringatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah yakin Anda ingin menghapus nilai siswa ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $('#confirmDelete').on('show.bs.modal', (e) => {
        var url = $(e.relatedTarget).data('url');

        $(e.currentTarget).find('form').attr('action', url);
    });
</script>
@endpush