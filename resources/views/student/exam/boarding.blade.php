@extends('layouts.student')

@section('content')
    <style>
        .divider {
            display: block;
            margin: 1rem 0px;
            height: 1px;
            background: #e5e5e5;
            width: 25%;
        }
    </style>
    <section class="section">
        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fa fa-clock mr-1"></i> Sebelum memulai ...</h4>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="mb-3">
                                    <p class="mb-0"><strong>Judul Ujian</strong></p>
                                    <p>{{ $exam->name }}</p>
                                </div>
                                <div class="mb-3">
                                    <p class="mb-0"><strong>Mata Pelajaran</strong></p>
                                    <p>{{$exam->examClass()->where('school_id', auth()->guard(session()->get('role'))->user()->school_id)->first()->subject->name}}</p>
                                </div>
                                <div class="mb-3">
                                    <p class="mb-0"><strong>Total Soal</strong></p>
                                    <p>{{$exam->examQuestions->count()}} soal</p>
                                </div>
                                <div class="mb-3">
                                    <p class="mb-0"><strong>Durasi</strong></p>
                                    <p>{{$exam->duration}} Menit</p>
                                </div>
                            </div>

                            <div class="border border-warning p-4 mt-5 mb-3">
                                <h6 class="mb-3">Petunjuk Pengerjaan</h6>
                                <ol class="mb-0 pl-4">
                                    <li>Berdoa kepada Tuhan YME sebelum melakukan ujian semoga diberi kemudahan dan kelancaran.</li>
                                    <li>Tombol mulai ujian akan dapat di klik apabila waktu tunggu ujian telah selesai dan jika soal sudah tersedia.</li>
                                    <li>Klik tombol mulai ujian untuk memulai ujian.</li>
                                </ol>
                            </div>
                        </div>
                        <div class="card-footer">
                            <form action="{{ route('student.exam.access', $exam->id) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="access_code">Kode Akses <i class="fa fa-question-circle"></i></label>
                                    <input type="text" name="access_code" id="access_code" class="form-control" placeholder="Masukan kode akses" autocomplete="off">
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Mulai Ujian</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection