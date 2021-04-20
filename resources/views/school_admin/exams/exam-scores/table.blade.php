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
                {{ $examScore->score ?? 'Belum Mengerjakan' }}
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="text-center">Tidak ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>