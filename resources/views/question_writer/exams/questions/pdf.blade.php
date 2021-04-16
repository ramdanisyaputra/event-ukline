<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="card">
    <div class="card-body">
        <div>
            <table>
                <tr>
                    <td>Judul Ujian</td>
                    <td class="px-2">:</td>
                    <td>{{$exam->name}}</td>
                </tr>
                <tr>
                    <td>Jenis Ujian</td>
                    <td class="px-2">:</td>
                    <td>{{$exam->examType->name}}</td>
                </tr>
                <tr>
                    <td>Durasi Ujian</td>
                    <td class="px-2">:</td>
                    <td>{{$exam->duration}} Menit</td>
                </tr>
                <tr>
                    <td>Tanggal Pelaksanaan</td>
                    <td class="px-2">:</td>
                    <td>{{ \Carbon\Carbon::parse($exam->started_at)->isoFormat('dddd, DD MMMM YYYY') }}</td>
                </tr>
            </table>
            <hr>
            <div class="mt-3">
                <ol class="pl-4">
                @foreach($examQuestions as $examQuestion)
                    <li class="pb-3">
                        <div class="ml-2">
                            {!! $examQuestion->question !!}
                        </div>
                        @if($examQuestion->question_type == 'PG')
                        <ol type="a" class="pl-3">
                            @foreach (json_decode($examQuestion->option) as $key => $option)
                            <li class="{{ $key == $examQuestion->answer ? 'text-primary font-weight-bold' : '' }}">{!! $option !!}</li>
                            @endforeach
                        </ol>
                        @endif
                    </li>
                @endforeach
                </ol>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
