@extends('layouts.student')

@section('title', 'Beranda')

@section('content')
<section class="section">

    <div class="section-body">
        <div class="row">
            @forelse ($exams as $exam)
            <div class="col-md-4 my-2">
                <div class="card exam-card">
                    <div class="card-body">
                        <div class="bg-light mb-3 text-center shadow-sm rounded exam-card-title">
                            <h4 class="m-0 text-primary">{{ $exam->name }}</h4>
                        </div>
                        <div>
                            <table class="w-100">
                                <tr>
                                    <td class=""><i class="far fa-clock mr-2"></i> Dimulai pada</td>
                                    <td class="font-weight-bold">{{ \Carbon\Carbon::parse($exam->started_at)->isoFormat('DD MMMM YYYY, HH:mm') }}</td>
                                </tr>
                                <tr>
                                    <td class=""><i class="far fa-bell mr-2"></i> Berakhir pada</td>
                                    <td class="font-weight-bold">{{ \Carbon\Carbon::parse($exam->expired_at)->isoFormat('DD MMMM YYYY, HH:mm') }}</td>
                                </tr>
                                <tr>
                                    <td class=""><i class="far fa-hourglass mr-2"></i> Durasi</td>
                                    <td class="font-weight-bold">{{ $exam->duration }} menit</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-transparent" data-target="#examDetail" data-toggle="modal" 
                            data-ex-type="{{ $exam->examType->name }}" 
                            data-ex-title="{{$exam->name}}"
                            data-ex-total="{{$exam->examQuestions->count()}}" 
                            data-ex-subject="{{$exam->examClass()->where('school_id', auth()->guard(session()->get('role'))->user()->school_id)->first()->subject->name}}"
                        >Detail</button>
                        @php
                            $exam_score = App\Models\ExamScore::where('student_id', auth()->guard(session()->get('role'))->user()->id)->where('exam_id', $exam->id)->first();
                        @endphp
                        @if (isset(session()->get('current_exams')[$exam->id]))
                        <a href="{{ route('student.exam.start', [$exam->id, session()->get('current_exams')[$exam->id]['token']]) }}" class="btn btn-warning">Lanjutkan</a>
                        @elseif (($exam_score->score ?? false) === '0')
                        <form action="{{ route('student.exam.restart', $exam->id ) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-dark">Ulang Ujian</button>
                        </form>
                        @elseif ($exam_score)
                        <a href="#" class="btn btn-success">Sudah Dikerjakan</a>
                        @else
                            @if (date('H:i:s', strtotime($exam->expired_at)) > date('H:i:s'))
                                @if(date('H:i:s', strtotime($exam->started_at)) <= date('H:i:s'))
                                    <a href="{{ route('student.exam.boarding', $exam->id ) }}" class="btn btn-primary">Mulai Ujian</a>
                                @else
                                    <a href="#" class="btn btn-success" data-toggle="modal" data-clock="{{date('H:i', strtotime($exam->started_at))}}" data-target="#forbidden" style="cursor: not-allowed" disabled>Mulai Ujian</a>
                                @endif
                            @else
                                <button class="btn btn-light" disabled>🚫 Sudah Terlambat</button>
                            @endif
                        @endif
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
                            <a href="#" class="mt-4 bb">Butuh bantuan? (FAQ)</a>
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
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Ujian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="w-100">
                    <tr>
                        <th class="text-secondary py-1 d-flex align-items-center" style="gap: 5px;"><i style="width: 15px;" class="fa fa-book-open mr-1"></i> Mata Pelajaran</th>
                        <td class="py-1 ex-subject"></td>
                    </tr>
                    <tr>
                        <th class="text-secondary py-1 d-flex align-items-center" style="gap: 5px;"><i style="width: 15px;" class="fa fa-graduation-cap mr-1"></i> Judul</th>
                        <td class="py-1 ex-title"></td>
                    </tr>
                    <tr>
                        <th class="text-secondary py-1 d-flex align-items-center" style="gap: 5px;"><i style="width: 15px;" class="fa fa-shapes mr-1"></i> Jenis Penilaian</th>
                        <td class="py-1 ex-type"></td>
                    </tr>
                    <tr>
                        <th class="text-secondary py-1 d-flex align-items-center" style="gap: 5px;"><i style="width: 15px;" class="fas fa-clipboard-list mr-1"></i> Jumlah Soal</th>
                        <td class="py-1 ex-total"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer pt-0">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="forbidden" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perhatian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Anda dapat mengerjakan ujian ini pada pukul <span class="clock text-danger"></span>
            </div>
            <div class="modal-footer pt-0">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $('#examDetail').on('show.bs.modal', (e) => {
        var subject = $(e.relatedTarget).data('ex-subject');
        var title = $(e.relatedTarget).data('ex-title');
        var type = $(e.relatedTarget).data('ex-type');
        var total = $(e.relatedTarget).data('ex-total');

        $(e.currentTarget).find('.ex-subject').html(subject);
        $(e.currentTarget).find('.ex-title').html(title);
        $(e.currentTarget).find('.ex-type').html(type);
        $(e.currentTarget).find('.ex-total').html(`${total} soal`);
    });
    
    $('#forbidden').on('show.bs.modal', (e) => {
        var clock = $(e.relatedTarget).data('clock');
        $(e.currentTarget).find('.clock').html(clock);
    });
    
</script>
@endpush