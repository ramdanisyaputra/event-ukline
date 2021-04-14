

<?php $__env->startSection('content'); ?>
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
                <form action="<?php echo e(route('question_writer.exams.store')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="form-group">
                        <label for="question">Pertanyaan</label>
                        <textarea class="form-control" name="question" id="question" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="answer">Jawaban</label>
                        <textarea class="form-control" name="answer" id="answer" cols="30" rows="10"></textarea>
                    </div>
                <button class="btn btn-primary" type="submit">Simpan</button>
                </form>
            </div>
        </div>

    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
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
<?php $__env->stopPush(); ?>    
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\event-ukline\resources\views/question_writer/exams/create.blade.php ENDPATH**/ ?>