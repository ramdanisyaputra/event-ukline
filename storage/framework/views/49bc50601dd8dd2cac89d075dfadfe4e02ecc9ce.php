

<?php $__env->startSection('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Nilai Ujian</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Beranda</a></div>
            <div class="breadcrumb-item">Daftar Ujian</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Ujian</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Ujian</th>
                                <th>Tanggal</th>
                                <th>Durasi</th>
                                <th>Matapelajaran</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $examClass; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $examKelas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(++$key); ?></td>
                                <td><?php echo e($examKelas->exam->name); ?> <span class="badge badge-light p-1 ml-1"><?php echo e(ucwords($examKelas->exam->shared ? 'Serentak' : 'Mandiri')); ?></span></td>
                                <td><?php echo e(\Carbon\Carbon::parse($examKelas->exam->started_at)->isoFormat('dddd, DD MMMM Y')); ?></td>
                                <td><?php echo e($examKelas->exam->duration); ?> menit</td>
                                <td><?php echo e($examKelas->subject->name); ?></td>
                                <td class="text-center">
                                    <a href="<?php echo e(route('school_admin.exam-scores.indexScore', $examKelas->exam_id)); ?>" class="btn btn-success">Pilih Ujian</a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\event-ukline\resources\views/school_admin/exams/exam-scores/index.blade.php ENDPATH**/ ?>