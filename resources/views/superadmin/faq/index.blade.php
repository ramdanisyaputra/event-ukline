@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>FAQ</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">FAQ</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar FAQ</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#kelolaFaq"><i class="fa fa-plus"></i> Tambah FAQ</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Pertanyaan</th>
                                <th>Jawaban</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($faqs as $key => $faq)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>
                                    @php
                                        $opsi = '';
                                        foreach(json_decode($faq->tags) as $j) {
                                            $opsi .= DB::table('tags')->where('id',$j)->first()->name . ", ";
                                        }
                                    @endphp

                                    {{ trim($opsi, ', ') }}
                                </td>
                                <td>{{ $faq->question }}</td>
                                <td>{{ $faq->answer }}</td>
                                <td class="text-center">
                                    <a href="{{route('superadmin.faqs.edit', $faq->id)}}" class="btn btn-success btn-sm"> <i class="fas fa-edit"></i> </a>
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

<div class="modal fade" id="kelolaFaq" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('superadmin.faqs.store') }}" method="POST" id="formKelolaFaq">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><span>Tambah</span> Provinsi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                    <label for="tags">Kategori</label>
                        <select class="js-example-basic-multiple" id="tags" name="tags[]" multiple="multiple">
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="question">Pertanyaan</label>
                        <textarea class="form-control" name="question" id="question" cols="30" rows="10"> {{old('question')}} </textarea>
                    </div>
                    <div class="form-group">
                        <label for="answer">Jawaban</label>
                        <textarea class="form-control" name="answer" id="answer" cols="30" rows="10"> {{old('question')}} </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $('#editFaq').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var name = $(e.relatedTarget).data('name');
        var tags = $(e.relatedTarget).data('tags');
        var question= $(e.relatedTarget).data('question');
        var answer= $(e.relatedTarget).data('answer');

        $('#editFaq').find('input[name="id"]').val(id);
        $('#editFaq').find('input[name="tags"]').val(tags);
        $('#editFaq').find('input[name="name"]').val(name);
        $('#editFaq').find('input[name="question"]').val(question);
        $('#editFaq').find('input[name="answer"]').val(answer);
    });
</script>
@endpush