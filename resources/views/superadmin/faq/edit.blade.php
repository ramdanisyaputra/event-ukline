@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>FAQ</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">FAQ </div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Ubah FAQ</h4>
            </div>
            <div class="card-body">
                <form action="{{route('superadmin.faqs.update')}}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$faq->id}}">
                    <div class="form-group">
                        <label for="question">Pertanyaan</label>
                        <textarea class="form-control" name="question" id="question" cols="30" rows="10">{{$faq->question}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="answer">Jawaban</label>
                        <textarea class="form-control" name="answer" id="answer" cols="30" rows="10">{{$faq->answer}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="tags">Kategori</label>
                            <select class="js-example-basic-multiple" id="tags" name="tags[]" multiple="multiple">
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}" 
                                @foreach (json_decode($faq->tags) as $ki)
                                    @if ($tag->id == $ki)
                                        selected
                                    @endif
                                @endforeach>{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>
                <button class="btn btn-primary" type="submit">Simpan</button>
                </form>
            </div>
        </div>

    </div>
</section>

@endsection

@push('script')
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });

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