@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Kabupaten</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Daftar Kabupaten</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Kabupaten</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kabupaten</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($regencies as $key => $regency)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $regency->name }}</td>
                                <td class="text-center">
                                    <a href="{{route('superadmin.question-writers.indexWriter', $regency->id)}}" class="btn btn-success">Pilih Kabupaten</a>
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


@push('script')
<script>
    $('#editProvince').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var name = $(e.relatedTarget).data('name');
        var province_code= $(e.relatedTarget).data('province-code');

        $('#editProvince').find('input[name="id"]').val(id);
        $('#editProvince').find('input[name="name"]').val(name);
        $('#editProvince').find('input[name="province_code"]').val(province_code);
    });
</script>
@endpush