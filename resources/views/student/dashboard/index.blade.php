@extends('layouts.student')

@section('content')
<section class="section">

    <div class="section-body">
        <div class="row">
            @forelse ($exams as $exam)
            <div class="col-md-4 my-2">
                <div class="card">
                    <div class="card-body">
                        <div class="py-2 mb-3 text-center">
                            <h4 class="m-0 bg-light text-primary p-3 rounded shadow-sm">{{ $exam->name }}</h4>
                        </div>
                        <div>
                            <table class="w-100">
                                <tr>
                                    <td class=""><i class="far fa-clock mr-2"></i> Dimulai pada</td>
                                    <td class="font-weight-bold">{{ \Carbon\Carbon::parse($exam->started_at)->format('H:i') }}</td>
                                </tr>
                                <tr>
                                    <td class=""><i class="far fa-bell mr-2"></i> Berakhir pada</td>
                                    <td class="font-weight-bold">{{ \Carbon\Carbon::parse($exam->expired_at)->format('H:i') }}</td>
                                </tr>
                                <tr>
                                    <td class=""><i class="far fa-hourglass mr-2"></i> Durasi</td>
                                    <td class="font-weight-bold">{{ $exam->duration }} menit</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-transparent" data-target="#examDetail" data-toggle="modal">Detail</button>
                        <a href="{{ route('student.exam.boarding', $exam->id ) }}" class="btn btn-primary">Mulai Ujian</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="empty-state" data-height="400">
                            <div class="empty-state-icon">
                                <i class="fas fa-question"></i>
                            </div>
                            <h2>Kami tidak dapat menemukan data ujian</h2>
                            <p class="lead">
                                Maaf kami tidak dapat menemukan data ujian, silahkan hubungi kami atau guru Anda terkait hal ini.
                            </p>
                            <a href="#" class="mt-4 bb">Butuh bantuan?</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="examDetail" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ujian Akhir Matematika Dasar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="w-100">
                    <tr>
                        <th class="py-1"><i class="fa fa-book-open mr-1"></i> Mata Pelajaran</th>
                        <td class="py-1">Matematika</td>
                    </tr>
                    <tr>
                        <th class="py-1"><i class="fa fa-graduation-cap mr-1"></i> Judul</th>
                        <td class="py-1">UTS Matematika SMP Kelas 10</td>
                    </tr>
                    <tr>
                        <th class="py-1"><i class="fa fa-shapes mr-1"></i> Jenis</th>
                        <td class="py-1">Tryout</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer pt-0">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection