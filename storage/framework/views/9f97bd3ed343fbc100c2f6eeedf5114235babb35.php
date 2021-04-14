

<?php $__env->startSection('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Ujian</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Ujian </div>
            <div class="breadcrumb-item">Tambah</div>
        </div>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Ujian</h4>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('question_writer.exams.store')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="name">Nama Ujian</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="started_at">Dimulai Pada</label>
                        <input type="datetime-local" class="form-control" name="started_at" id="started_at">
                    </div>
                    <div class="form-group">
                        <label for="expired_at">Berakhir Pada</label>
                        <input type="datetime-local" class="form-control" name="expired_at" id="expired_at">
                    </div>
                    <div class="form-group">
                        <label for="duration">Durasi</label>
                        <input type="number" class="form-control" name="duration" id="duration">
                    </div>
                    <div class="form-group">
                        <label for="access_code">Kode Akses</label>
                        <input type="text" class="form-control" name="access_code" id="access_code">
                    </div>
                    <div class="form-group">
                        <label for="exam_type_id">Jenis Ujian</label>
                        <select name="exam_type_id" id="exam_type_id" class="form-control" required>
                            <option value=""> ~ Pilih ~</option>
                            <?php $__currentLoopData = $examTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($exam->id); ?>"><?php echo e($exam->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                <button class="btn btn-primary" type="submit">Simpan</button>
                </form>
            </div>
        </div>

    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\event-ukline\resources\views/question_writer/exams/create.blade.php ENDPATH**/ ?>